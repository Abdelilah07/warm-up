import './bootstrap';
import Alpine from 'alpinejs';
import $ from 'jquery';

window.Alpine = Alpine;

Alpine.start();


window.$ = $;

// Delete book function
window.deleteBook = function (id, url) {
    if (confirm('Êtes-vous sûr de vouloir supprimer ce livre ?')) {
        $.ajax({
            url: url,
            method: 'POST',
            data: {
                _method: 'DELETE',
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                $('#book-row-' + id).remove();
            },
            error: function (xhr) {
                alert('Erreur lors de la suppression : ' +
                    (xhr.responseJSON?.message || 'Une erreur est survenue'));
            }
        });
    }
};

// Add book
function initializeBookForm() {
    $('#create-book-form').on('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        const $messages = $('#messages');

        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function () {
                $messages.html('');
                $('button[type="submit"]').prop('disabled', true);
            },
            success: function (response) {
                if (response?.success) {
                    $messages.html(`
                        <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6">
                            <p class="text-sm text-green-700">${response.message}</p>
                        </div>
                    `);
                    setTimeout(() => {
                        window.location.href = response.redirect;
                    }, 2000);
                }
            },
            error: function (xhr) {
                let errors = xhr.responseJSON?.errors || {};
                let errorList = Object.values(errors).flat().map(error =>
                    `<li class="text-red-700">${error}</li>`
                ).join('');

                $messages.html(`
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
                        <ul class="list-disc pl-4">${errorList}</ul>
                    </div>
                `);
            },
            complete: function () {
                $('button[type="submit"]').prop('disabled', false);
            }
        });
    });
}

function initializeEditBookForm() {
    $('#edit-book-form').on('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        const $messages = $('#messages');

        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function () {
                $messages.html('');
                $('button[type="submit"]').prop('disabled', true);
            },
            success: function (response) {
                if (response?.success) {
                    $messages.html(`
                        <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6">
                            <p class="text-sm text-green-700">${response.message}</p>
                        </div>
                    `);
                    setTimeout(() => {
                        window.location.href = response.redirect;
                    }, 2000);
                }
            },
            error: function (xhr) {
                let errors = xhr.responseJSON?.errors || {};
                let errorList = Object.values(errors).flat().map(error =>
                    `<li class="text-red-700">${error}</li>`
                ).join('');

                $messages.html(`
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
                        <ul class="list-disc pl-4">${errorList}</ul>
                    </div>
                `);
            },
            complete: function () {
                $('button[type="submit"]').prop('disabled', false);
            }
        });
    });
}

// Initialize in your app.js ready handler
$(document).ready(function () {
    initializeBookForm();
    initializeEditBookForm();
});