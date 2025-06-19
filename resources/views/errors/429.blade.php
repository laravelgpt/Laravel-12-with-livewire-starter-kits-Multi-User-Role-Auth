<x-error-page 
    code="429" 
    title="Too Many Requests" 
    description="You've made too many requests recently. Please wait a moment before trying again."
    :showBackButton="false"
>
    <div class="mt-6 p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg">
        <p class="text-sm text-blue-800 dark:text-blue-200">
            <strong>Rate Limit:</strong> This helps us provide a better experience for all users. Please try again in a few minutes.
        </p>
    </div>
</x-error-page> 