<div aria-live="polite" aria-atomic="true" class="position-fixed top-0 end-0 p-3" style="z-index: 1080;">
    <div id="deleteToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="5000">
        <div class="toast-header">
            <strong class="me-auto text-danger">Notice</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body" id="toastMsg">
            delete
        </div>
    </div>
</div>
<script>
    function toast(message) {
        const toastEl = document.getElementById('deleteToast');
        const msgEl = document.getElementById('toastMsg');

        if (toastEl && msgEl) {
            msgEl.innerText = message;
            const toast = new bootstrap.Toast(toastEl, {
                delay: 2600
            });
            toast.show();
        } else {
            console.error('Toast elements not found in DOM');
        }
    }
</script>
