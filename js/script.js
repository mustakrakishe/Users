const STATUS_CONTAINER = '#status';
const SEED_FORM = 'form#seed';
const USERS_TABLE = 'table#users';
const USER_ROWS = 'tr[name=user]';

const AGE_MIN_INPUT = 'input#age-min';
const AGE_MAX_INPUT = 'input#age-max';
const AGE_MIN_OUTPUT = 'output#age-min-output';
const AGE_MAX_OUTPUT = 'output#age-max-output';

const SEARCH_FORM = 'form#search';
const SEARCH_FORM_INPUTS = 'input[form=search]';

// init

displayAgeMin();
displayAgeMax();
$(STATUS_CONTAINER).html('Обновляю таблицу...');
refreshTable();
$(STATUS_CONTAINER).html('Готово.');

// listeners

$(document).on('submit', SEED_FORM, seedFormSubmitHandler);

$(document).on('input', AGE_MIN_INPUT, ageMinInputHandler);
$(document).on('input', AGE_MAX_INPUT, ageMaxInputHandler);

$(document).on('submit', SEARCH_FORM, searchFormSubmitHandler);
$(document).on('input', SEARCH_FORM_INPUTS, inputHandler);

// handlers

async function seedFormSubmitHandler(event) {
    event.preventDefault();

    $(STATUS_CONTAINER).html('Добавляю записи...');
    await seedUsers();
    $(STATUS_CONTAINER).html('Обновляю таблицу...');
    await refreshTable();
    $(STATUS_CONTAINER).html('Готово.');
}

function ageMinInputHandler() {
    displayAgeMin();
}
function ageMaxInputHandler() {
    displayAgeMax();
}

async function searchFormSubmitHandler(event) {
    event.preventDefault();

    $(STATUS_CONTAINER).html('Обновляю таблицу...');
    await refreshTable();
    $(STATUS_CONTAINER).html('Готово.');
}

function inputHandler() {
    let formId = $(this).attr('form');
    $('#' + formId).submit();
}

// helpers

function displayAgeMin() {
    let value = $(AGE_MIN_INPUT).val();
    $(AGE_MIN_OUTPUT).val(value);
}

function displayAgeMax() {
    let value = $(AGE_MAX_INPUT).val();
    $(AGE_MAX_OUTPUT).val(value);
}

async function seedUsers() {
    let response = await $.post({
        url: $(SEED_FORM).attr('action'),
        data: $(SEED_FORM).serialize(),
    });
}

async function refreshTable() {
    let response = await $.get({
        url: $(SEARCH_FORM).attr('action'),
        data: $(SEARCH_FORM).serialize(),
    });

    response = JSON.parse(response);

    if (response.status === 1) {
        $(USERS_TABLE).find(USER_ROWS).remove();
        $('#no-results').remove();

        let hits = response.hits;

        if (hits.length) {
            hits.forEach(hit => {
                let user = hit._source;

                let tableRow =
                    '<tr name="user">'
                    + '<td>' + user.age + '</td>'
                    + '<td>' + user.name + '</td>'
                    + '<td>' + user.email + '</td>'
                    + '<td>' + user.phone + '</td>'
                    + '</tr>';

                $(USERS_TABLE).children('tbody').append(tableRow);
            });
        }
        else {
            $(USERS_TABLE).after('<div id="no-results" class="text-center">No results.</div>');
        }
    }
}