<script>
    document.querySelectorAll('.password-toggle').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const field = document.getElementById(btn.dataset.target);
            const icon = btn.querySelector('i');
            if (!field || !icon) return;

            const isHidden = field.type === 'password';
            field.type = isHidden ? 'text' : 'password';
            btn.setAttribute('aria-pressed', isHidden ? 'true' : 'false');
            btn.setAttribute('aria-label', isHidden ? 'Hide password' : 'Show password');

            icon.classList.remove('fa-eye', 'fa-eye-slash');
            icon.classList.add(isHidden ? 'fa-eye-slash' : 'fa-eye');
        });
    });
</script>
