<x-error-page 
    code="419" 
    title="Page Expired" 
    description="Sorry, your session has expired. Please refresh and try again."
    :showBackButton="false"
>
    <div class="mt-6 p-4 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg">
        <p class="text-sm text-yellow-800 dark:text-yellow-200">
            <strong>Tip:</strong> This usually happens when you've been inactive for too long or when the page was refreshed.
        </p>
    </div>
</x-error-page> 