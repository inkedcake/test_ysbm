/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
$("#btn-add-shipment").click(function (e) {
    var state = $('#btn-add-shipment').val();
    var todo_id = $('#todo_id').val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    e.preventDefault();
    $.ajax({
        url: "/dashboard/create",
        method: 'post',
        data: {
            name: $('#name').val(),
        },
        success: function (result) {
            var todo = '<tr  class="d-flex"><th class="col-2" scope="row">' + result['data'].id + '</th><td class="col-sm-8">' + result['data'].name + '</td>';
            todo += ' <td class="col-2">\n' +
                '<a class="btn btn-info" href="/dashboard/'+result['data'].id+'/list_items">\n' +
                ' <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-card-list" fill="currentColor" xmlns="http://www.w3.org/2000/svg">\n' +
                ' <path fill-rule="evenodd" d="M14.5 3h-13a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>\n' +
                ' <path fill-rule="evenodd" d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5z"/>\n' +
                ' <circle cx="3.5" cy="5.5" r=".5"/>\n' +
                ' <circle cx="3.5" cy="8" r=".5"/>\n' +
                ' <circle cx="3.5" cy="10.5" r=".5"/>\n' +
                ' </svg>\n' +
                ' </a>\n' +
                ' <button class="btn btn-danger btn-delete-shipment" value="' + result['data'].id + '" disabled="disabled">\n' +
                ' <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">\n' +
                ' <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>\n' +
                '<path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>\n' +
                ' </svg>\n' +
                '</button>\n' +
                '</td></tr>';
            $('#todos-list').append(todo);
        }
    });
});
$(".btn-delete-shipment").click(function (e) {
    var state = $(this).val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    e.preventDefault();
    $.ajax({
        url: "/dashboard/delete",
        method: 'post',
        data: {
            id: state,
        },
        success: function () {
            $('#' + state).remove();
        }
    });
});
$("#btn-add-item").click(function (e) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    e.preventDefault();
    $.ajax({
        url: "/items/create",
        method: 'post',
        data: {
            name: $('#name').val(),
            code: $('#code').val(),
            shipment_id: $('#shipment_id').val(),

        },
        success: function (result) {
            var todo = '<tr  class="d-flex"><th class="col-2" scope="row">' + result['data'].id + '</th><td class="col-sm-4">' + result['data'].name + '</td><td class="col-sm-4">' + result['data'].code + '</td>';
            todo += ' <td class="col-2">\n' +
                '<a class="btn btn-info" href="/dashboard/' + result['data'].shipment_id + '/item/' + result['data'].id + '/edit">\n' +
                '<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">' +
                '<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>' +
                '<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>' +
                '</svg>' +
                ' </a>\n' +
                ' <button class="btn btn-danger btn-delete-item" value="' + result['data'].id + '" disabled="disabled">\n' +
                ' <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">\n' +
                ' <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>\n' +
                '<path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>\n' +
                ' </svg>\n' +
                '</button>\n' +
                '</td></tr>';
            $('#items-list').append(todo);
        }
    });
});
$(".btn-delete-item").click(function (e) {
    var state = $(this).val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    e.preventDefault();
    $.ajax({
        url: "/item/delete",
        method: 'post',
        data: {
            id: state,
        },
        success: function () {
            $('#' + state).remove();
        }
    });
});

$("#item_update").click(function (e) {
    var shipment_id = $('#shipment_id').val();
    var name = $('#name').val();
    var code = $('#code').val();
    var id = $(this).val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    e.preventDefault();
    $.ajax({
        url: "/item/edit",
        method: 'post',
        data: {
            id:id,
            name: name,
            code: code,
            shipment_id: shipment_id,

        },
        success: function () {
            alert('Updated')
        }
    });
});