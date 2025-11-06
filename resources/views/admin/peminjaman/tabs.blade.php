<div class="border-b border-gray-200 text-center text-sm font-medium text-gray-500">
    <ul class="-mb-px flex flex-wrap">
        <li class="me-2">
            <form method="get">
                <input type="hidden" name="tab" value="pending">
                <button type="submit"
                    class="@if ($tab === 'pending') border-b-2 @endif  inline-block rounded-t-lg border-blue-600 p-4 hover:border-gray-300 hover:text-gray-600"
                    aria-current="page">Pengajuan</button>
            </form>
        </li>
        <li class="me-2">
            <form method="get">
                <input type="hidden" name="tab" value="approved">
                <button type="submit"
                    class="@if ($tab === 'approved') border-b-2 @endif inline-block rounded-t-lg border-blue-600 p-4 hover:border-gray-300 hover:text-gray-600"
                    aria-current="page">Diterima</button>
            </form>
        </li>
    </ul>
</div>
