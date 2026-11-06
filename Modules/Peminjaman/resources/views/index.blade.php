<x-peminjaman::layouts.master>
    <h1>Hello World</h1>

    <p>Module: {!! config('peminjaman.name') !!}</p>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#formPeminjaman').on('submit', function (e) {
            e.preventDefault();

            let formData = new FormData(this);
            let id = $('#peminjaman_id').val();
            let url = id ? `/peminjaman/${id}` : '/peminjaman';

            if (id) {
                formData.append('_method', 'PUT');
            }

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    alert(response.message);
                    location.reload();
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        $('.error-text').text('');

                        $.each(errors, function (key, value) {
                            $('#error_' + key).text(value[0]);
                        });
                    }
                }
            });
        });
    </script>
</x-peminjaman::layouts.master>
