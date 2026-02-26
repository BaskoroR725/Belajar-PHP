<?php
function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function formatRupiah(int $value): string
{
    return 'Rp ' . number_format($value, 0, ',', '.');
}
