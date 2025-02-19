<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Gestion des Livres</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="flex flex-col min-h-screen bg-gray-50">
    @include('partials.navbar')

    <main class="flex-grow container mx-auto px-4 py-8">
        @yield('content')
    </main>

    <div id="notification-container" class="fixed top-4 right-4 z-50"></div>

    @include('partials.footer')

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Book creation handler
        function createBook(formData) {
            $.ajax({
                url: '/livres',
                type: 'POST',
                data: formData,
                processData: false, // Required for FormData
                contentType: false, // Required for FormData
                success: function(response) {
                    // Show success message
                    showNotification('Livre ajouté avec succès!', 'success');

                    // Redirect to index page or update table
                    window.location.href = '/livres';
                },
                error: function(xhr) {
                    // Handle validation errors
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        displayErrors(errors);
                    } else {
                        showNotification('Une erreur est survenue', 'error');
                    }
                }
            });
        }

        // Book update handler
        function updateBook(id, formData) {
            formData.append('_method', 'PUT'); // Laravel requires this for PUT requests

            $.ajax({
                url: `/livres/${id}`,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    showNotification('Livre mis à jour avec succès!', 'success');
                    window.location.href = '/livres';
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        displayErrors(errors);
                    } else {
                        showNotification('Une erreur est survenue', 'error');
                    }
                }
            });
        }

        // Book deletion handler
        function deleteBook(id) {
            if (confirm('Êtes-vous sûr ?')) {
                $.ajax({
                    url: `/livres/${id}`,
                    type: 'DELETE',
                    success: function(response) {
                        // Remove the table row
                        $(`#book-row-${id}`).fadeOut(300, function() {
                            $(this).remove();
                        });
                        showNotification('Livre supprimé avec succès!', 'success');
                    },
                    error: function() {
                        showNotification('Une erreur est survenue', 'error');
                    }
                });
            }
        }

        // Utility function to display errors
        function displayErrors(errors) {
            // Clear previous errors
            $('.error-message').remove();

            // Display new errors
            Object.keys(errors).forEach(field => {
                const input = $(`#${field}`);
                const errorMessage = errors[field][0];
                input.after(`<span class="error-message text-red-500 text-sm">${errorMessage}</span>`);
            });
        }

        // Utility function to show notifications
        function showNotification(message, type) {
            const bgColor = type === 'success' ? 'bg-green-50' : 'bg-red-50';
            const textColor = type === 'success' ? 'text-green-700' : 'text-red-700';
            const borderColor = type === 'success' ? 'border-green-500' : 'border-red-500';

            const notification = `
        <div class="${bgColor} border-l-4 ${borderColor} p-4 mb-6 notification">
            <div class="flex">
                <div class="ml-3">
                    <p class="text-sm ${textColor}">${message}</p>
                </div>
            </div>
        </div>
    `;

            // Add notification to page
            $('#notification-container').html(notification);

            // Remove after 3 seconds
            setTimeout(() => {
                $('.notification').fadeOut();
            }, 3000);
        }
    </script>
</body>

</html>