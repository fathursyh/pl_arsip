<div class="border-b border-gray-200 text-center text-sm font-medium text-gray-500">
    <ul class="-mb-px flex flex-wrap">
        <li class="me-4">
            <form method="get" class="flex items-center">
                <input type="hidden" name="tab" value="pending">
                <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                        d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm9.408-5.5a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2h-.01ZM10 10a1 1 0 1 0 0 2h1v3h-1a1 1 0 1 0 0 2h4a1 1 0 1 0 0-2h-1v-4a1 1 0 0 0-1-1h-2Z"
                        clip-rule="evenodd" />
                </svg>
                <button type="submit"
                    class="@if ($tab === 'pending') border-b-2 text-blue-600 @endif inline-block rounded-t-lg border-blue-600 p-2 py-4 hover:text-gray-600"
                    aria-current="page">Pengajuan</button>
            </form>
        </li>
        <li class="me-4">
            <form method="get" class="flex items-center">
                <input type="hidden" name="tab" value="approved">
                <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                        d="M12 2c-.791 0-1.55.314-2.11.874l-.893.893a.985.985 0 0 1-.696.288H7.04A2.984 2.984 0 0 0 4.055 7.04v1.262a.986.986 0 0 1-.288.696l-.893.893a2.984 2.984 0 0 0 0 4.22l.893.893a.985.985 0 0 1 .288.696v1.262a2.984 2.984 0 0 0 2.984 2.984h1.262c.261 0 .512.104.696.288l.893.893a2.984 2.984 0 0 0 4.22 0l.893-.893a.985.985 0 0 1 .696-.288h1.262a2.984 2.984 0 0 0 2.984-2.984V15.7c0-.261.104-.512.288-.696l.893-.893a2.984 2.984 0 0 0 0-4.22l-.893-.893a.985.985 0 0 1-.288-.696V7.04a2.984 2.984 0 0 0-2.984-2.984h-1.262a.985.985 0 0 1-.696-.288l-.893-.893A2.984 2.984 0 0 0 12 2Zm3.683 7.73a1 1 0 1 0-1.414-1.413l-4.253 4.253-1.277-1.277a1 1 0 0 0-1.415 1.414l1.985 1.984a1 1 0 0 0 1.414 0l4.96-4.96Z"
                        clip-rule="evenodd" />
                </svg>
                <button type="submit"
                    class="@if ($tab === 'approved') border-b-2 text-blue-600 @endif inline-block rounded-t-lg border-blue-600 p-2 py-4 hover:text-gray-600"
                    aria-current="page">Diterima</button>
            </form>
        </li>
    </ul>
</div>
