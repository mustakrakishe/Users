const SEED_USERS_FORM = 'form#seedUsers';

$(document).on('submit', SEED_USERS_FORM, seedUsers)

async function seedUsers(event){
    event.preventDefault();

    $('pre').append('Гружу..');

    let form = event.target;

    let response = await $.post({
        url: $(form).attr('action'),
        data: $(form).serialize(),
    });

    $('pre').html(response);
}