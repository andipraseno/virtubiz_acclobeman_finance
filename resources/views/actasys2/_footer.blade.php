<script src="{{ url('/bootstrap') }}/js/bootstrap.bundle.min.js"></script>

<script src="{{ url('/components/axios.min.js') }}"></script>
<script src="{{ url('/components/cleave.min.js') }}"></script>
<script src="{{ url('/components/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ url('/components/flatpickr/id.js') }}"></script>

<script>
    document.getElementById('logout-link').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default action

        Swal.fire({
            title: 'Logout dari aplikasi?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, logout',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to the logout URL
                window.location.href = "{{ url('/logout') }}";
            }
        });
    });
</script>
