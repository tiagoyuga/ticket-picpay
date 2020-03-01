<?php

Route::namespace('Panel')
    ->middleware(['auth.panel', 'auth'])
    ->prefix('panel')
    ->group(function ($panel) {

        $panel->get('/', 'DashboardController@index')->name("dashboard");
        $panel->get('/dashboard', 'DashboardController@dashboard')->name("dashboard.dashboard");
        $panel->get('/report/users/registrations-day', 'DashboardController@reportUserRegistrationByDay')->name("report.users.userRegistration");

        /* panel/profile */
        $panel->put('profile', 'ProfileController@profileUpdate')->name('profiles.profileUpdate');
        $panel->get('profile', 'ProfileController@profile')->name('profiles.form');
        $panel->get('activity', 'ProfileController@activity')->name('profiles.activity');
        $panel->get('activities', 'ProfileController@activities')->name('profiles.activities');
        $panel->put('profile', 'ProfileController@update')->name('profiles.update');
        $panel->post('resume', 'ProfileController@resume')->name('profiles.resume');

//        /* panel/profile */
//     $panel->get('profile', 'AdministratorController@profile')->name('administrators.profile');

//      $panel->get('administrators/{user}/profiles', 'ProfileController@index')->name('administrators.profiles');
//        $panel->post('administrators/{user}/profile/add', 'ProfileController@store')->name('administrators.profile.add');
//        $panel->delete('administrators/{user}/profile/{profile}/remove', 'ProfileController@destroy')->name('administrators.profile.remove');
//        $panel->post('administrators/profile/{profile}/toggle', 'ProfileController@toggleActive')->name('administrators.profile.toggleActive');

        /* panel/users */
        $panel->get('users/find', 'UserController@find')->name('users.find');
        $panel->put('users/image', 'UserController@updateImageCrop')->name('users.updateImageCrop');
        $panel->get('users/crop/{id}', 'UserController@imageCrop')->name('users.imageCrop');
        $panel->get('users/{user}/skills', 'UserController@skills')->name('users.skills');
        $panel->put('users/{user}/update-skills', 'UserController@updateSkills')->name('users.updateSkills');
        $panel->get('users/attachments/{attachment}/download', 'UserController@download')->name('users.download');
        $panel->resource('users', UserController::class);

        /* panel/clients */
        $panel->get('clients/find', 'ClientController@find')->name('clients.find');
        $panel->put('clients/image', 'ClientController@updateImageCrop')->name('clients.updateImageCrop');
        $panel->get('clients/crop/{id}', 'ClientController@imageCrop')->name('clients.imageCrop');
        $panel->resource('clients', ClientController::class);

        /* panel/types */
        $panel->resource('types', TypeController::class);

        /* panel/ratings */
        $panel->resource('ratings', RatingController::class)->only(['index']);

        /* panel/configurations */
        $panel->resource('configurations', ConfigurationController::class);

        /* panel/dev_skill_categories */
        $panel->resource('dev_skill_categories', DevSkillCategoryController::class);

        /* panel/dev_skill_options */
        $panel->resource('dev_skill_options', DevSkillOptionController::class);

    /* panel/groups */
        $panel->resource('groups', GroupController::class);

    /* panel/quotes */
        $panel->resource('quotes', QuoteController::class);

    /* panel/quote_items */
        $panel->resource('quote_items', QuoteItemController::class);

    /* panel/quote_versions */
        $panel->resource('quote_versions', QuoteVersionController::class);

    /* panel/projects */
        $panel->resource('projects', ProjectController::class);

    /* panel/sections */
        $panel->resource('sections', SectionController::class);

    /* panel/sub_sections */
        $panel->resource('sub_sections', SubSectionController::class);

    /* panel/ticket_status */
        $panel->resource('ticket_status', TicketStatusController::class);

    /* panel/tickets */
        $panel->resource('tickets', TicketController::class);

    /* panel/ticket_comments */
        $panel->resource('ticket_comments', TicketCommentController::class);

        # rotas para panel

        /*
         * Rotas de relatórios
         * */

        /*
         * Rotas de crop de imagens
         * */
    });
