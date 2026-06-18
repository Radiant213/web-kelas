<footer class="footer">
    <div class="footer-content">
        <div class="footer-column">
            <h3>Tentang Kami</h3>
            <p style="color: #cbd5e1; line-height: 1.6;">
                Kelas XI PPLG 2 adalah wadah bagi para calon pengembang perangkat lunak muda untuk berkreasi,
                berinovasi, dan berkolaborasi dalam menciptakan solusi teknologi.
            </p>
        </div>
        <div class="footer-column">
            <h3>Link Cepat</h3>
            <ul class="footer-links">
                <li><a href="https://drive.google.com/drive/folders/1FHYxq4QRpPZb31eFeGFPP-iU3PoY5LKZ">Jadwal
                        Pelajaran</a></li>
                <li><a href="#" class="hover:text-primary-500 transition-colors">Tentang Kami</a></li>
            </ul>
        </div>
        <div class="footer-column">
            <h3>Kontak</h3>
            <ul class="footer-links">
                <li><a href="https://www.instagram.com/sofentwo_?igsh=MzAyZ2R0ZHBpNGh1">Instagram: @sofentwo_</a></li>
                <li><a href="https://www.instagram.com/mjundihanif">Wali Kelas: Muhammad Jundi Hanif</a></li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2026 XI PPLG 2. All rights reserved.</p>
    </div>
</footer>

<style>
    /* Footer */
    .footer {
        background: var(--dark, #1e293b);
        color: white;
        padding: 60px 0 30px;
        margin-top: auto;
    }

    .footer-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 40px;
        margin-bottom: 40px;
    }

    .footer-column h3 {
        font-size: 20px;
        margin-bottom: 20px;
        color: var(--secondary, #0ea5e9);
        font-weight: 700;
    }

    .footer-links {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-links li {
        margin-bottom: 12px;
    }

    .footer-links a {
        color: #cbd5e1;
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: inline-block;
        position: relative;
    }

    .footer-links a:hover {
        color: white;
        transform: translateX(6px);
    }

    .footer-bottom {
        text-align: center;
        padding-top: 30px;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        color: #94a3b8;
        font-size: 14px;
    }

    @media (max-width: 768px) {
        .footer {
            padding: 40px 0 20px;
        }

        .footer-content {
            grid-template-columns: 1fr;
            gap: 30px;
            text-align: center;
        }
    }
</style>