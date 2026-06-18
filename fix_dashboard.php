<?php
$file = 'c:\\laragon\\www\\webkelas\\resources\\views\\dashboard.blade.php';
$content = file_get_contents($file);

// Replace route
$content = preg_replace(
    "/href=\"\\{\\{\\s*route\\('student\\.show',\\s*\\$([a-zA-Z0-9_\\['\\]]+)->student->user_id\\)\\s*\\}\\}\"/",
    "href=\"{{ \\$$1->student ? route('student.show', \\$$1->student->user_id) : '#' }}\"",
    $content
);

// Replace ->student-> with ->student?-> where appropriate (not in the route which is fixed above)
$content = preg_replace("/->student->(full_name|nickname|photo|user_id)/", "->student?->$1", $content);

// Replace ->user-> with ->user?->
$content = preg_replace("/->user->(username|id)/", "->user?->$1", $content);

// Add 'Belum Ditentukan' fallback if missing
$content = preg_replace(
    "/\\?\\? \\$([a-zA-Z0-9_\\['\\]]+)->user\\?->username \\}\\}/",
    "?? \\$$1->user?->username ?? 'Belum Ditentukan' }}",
    $content
);

// Fix ui-avatars name
$content = preg_replace(
    "/urlencode\\(\\$([a-zA-Z0-9_\\['\\]]+)->student\\?->full_name \\?\\? \\$([a-zA-Z0-9_\\['\\]]+)->user\\?->username\\)/",
    "urlencode(\\$$1->student?->full_name ?? \\$$1->user?->username ?? 'Belum Ditentukan')",
    $content
);

file_put_contents($file, $content);
echo "Dashboard fixed.\n";
