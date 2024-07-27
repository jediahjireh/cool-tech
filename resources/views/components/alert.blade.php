<!-- resources/views/components/alert.blade.php -->

<!-- define default properties for alert Blade component -->
@props(['type' => 'info', 'message'])

<!-- centre alert -->
<div class="userAlert">
    <!-- HTML markup for the alert -->
    <div {{ $attributes->merge(['class' => 'alert alert-' . $type]) }} role="alert">
        <!-- display the alert message -->
        {{ $message }}

        <!-- close button for dismissing the alert -->
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="closeAlert(this)">
            <!-- close icon (x) -->
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>

<!-- JavaScript code -->
<script>
    // function to hide alert
    function closeAlert(button) {
        // hide alert display
        button.parentElement.style.display = 'none';
    }
</script>
