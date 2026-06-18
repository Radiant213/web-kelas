<?php

namespace App\Filament\Resources\Students\Pages;

use App\Filament\Resources\Students\StudentResource;
use App\Models\Grade;
use App\Models\Subject;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;

class ManageStudentGrades extends Page implements HasSchemas
{
    use InteractsWithSchemas;

    protected static string $resource = StudentResource::class;

    protected string $view = 'filament.resources.students.pages.manage-student-grades';

    public $record;

    public function getTitle(): string | Htmlable
    {
        return 'Input Nilai: ' . $this->record->full_name;
    }

    public ?array $data = [];

    public function mount(int | string $record): void
    {
        // Manual record resolution
        $this->record = StudentResource::getEloquentQuery()->findOrFail($record);

        $grades = Grade::where('user_id', $this->record->user_id)->get();

        $semesters = $grades->groupBy('semester')->map(function ($semesterGrades, $semester) {
            $item = ['semester' => $semester];
            foreach ($semesterGrades as $grade) {
                $item['subject_' . $grade->subject_id] = $grade->score;
            }
            return $item;
        })->values()->toArray();

        if (empty($semesters)) {
            $semesters = [['semester' => '1']];
        }

        // Use getSchema to access the schema/form
        $this->getSchema('form')->fill(['semesters' => $semesters]);
    }

    public function form(Schema $schema): Schema
    {
        $subjects = Subject::all();

        return $schema
            ->components([
                Repeater::make('semesters')
                    ->label('Daftar Semester')
                    ->addActionLabel('Tambah Tabel Semester')
                    ->schema([
                        TextInput::make('semester')
                            ->label('Semester ke-')
                            ->numeric()
                            ->required()
                            ->columnSpanFull()
                            ->placeholder('Contoh: 1'),
                        
                        Section::make('Mata Pelajaran')
                            ->description('Silakan isi nilai untuk mata pelajaran di bawah ini.')
                            ->components(function () use ($subjects) {
                                $fields = [];
                                foreach ($subjects as $subject) {
                                    $fields[] = TextInput::make('subject_' . $subject->id)
                                        ->label($subject->name)
                                        ->numeric()
                                        ->minValue(0)
                                        ->maxValue(100)
                                        ->suffix('KKM: ' . $subject->kkm);
                                }
                                return $fields;
                            })
                            ->columns(2)
                            ->compact()
                    ])
                    ->collapsible()
                    ->defaultItems(1)
                    ->itemLabel(fn (array $state): ?string => isset($state['semester']) ? 'Semester ' . $state['semester'] : null)
                    ->reorderable(true)
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $state = $this->getSchema('form')->getState();
        $userId = $this->record->user_id;
        $touchedGradeIds = [];

        foreach ($state['semesters'] as $semesterItem) {
            $semester = $semesterItem['semester'];
            
            foreach ($semesterItem as $key => $value) {
                if (str_starts_with($key, 'subject_') && $value !== null && $value !== '') {
                    $subjectId = substr($key, strlen('subject_'));
                    
                    $grade = Grade::updateOrCreate(
                        [
                            'user_id' => $userId,
                            'subject_id' => $subjectId,
                            'semester' => $semester,
                        ],
                        [
                            'score' => $value
                        ]
                    );
                    $touchedGradeIds[] = $grade->id;
                }
            }
        }

        if (count($touchedGradeIds) > 0) {
             Grade::where('user_id', $userId)->whereNotIn('id', $touchedGradeIds)->delete();
        } else {
             if(isset($state['semesters'])) {
                 Grade::where('user_id', $userId)->delete();
             }
        }
        
        Notification::make() 
            ->title('Nilai berhasil disimpan')
            ->success()
            ->send();
    }
}
