const STATUS_CONTAINER = '#status';
const SEED_USERS_FORM = 'form#seedUsers';
const USERS_TABLE_BODY = 'table#users tbody';

refreshUsersTable();

$(document).on('submit', SEED_USERS_FORM, seedUsers);

async function seedUsers(event){
    event.preventDefault();

    $(STATUS_CONTAINER).html('Добавляю записи...');

    let form = event.target;

    let response = await $.post({
        url: $(form).attr('action'),
        data: $(form).serialize(),
    });

    refreshUsersTable();
}

async function refreshUsersTable(){
    $(STATUS_CONTAINER).html('Обновляю таблицу...');

    let response = await $.get('http/index.php');

    $(USERS_TABLE_BODY).empty();

    let hits = JSON.parse(response);

    if(hits.length){
        hits.forEach(hit => {
            let user = hit._source;

            let tableRow =
            '<tr>'
                + '<td>' + user.age + '</td>'
                + '<td>' + user.name + '</td>'
                + '<td>' + user.email + '</td>'
                + '<td>' + user.phone + '</td>'
            + '</tr>';

            $(USERS_TABLE_BODY).append(tableRow);
        });
    }
    else{
        $(USERS_TABLE_BODY).append('No results.');
    }

    
    $(STATUS_CONTAINER).html('Готово.');
}