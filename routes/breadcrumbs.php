<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});


// Home > Users
Breadcrumbs::for('users', function ($trail) {
    $trail->parent('home');
    $trail->push('User', route('users'));
});


// Home > Users > New
Breadcrumbs::for('users.create', function ($trail) {
    $trail->parent('users');
    $trail->push('New', route('users.create'));
});

// Home > Users > Edit
Breadcrumbs::for('users.edit', function ($trail, $user) {
    $trail->parent('users');
    $trail->push('Edit', route('users.edit', $user));
});


// Home > Users > Show
Breadcrumbs::for('users.show', function ($trail, $user) {
    $trail->parent('users');
    $trail->push('Show', route('users.show', $user));
});

// Home > Users > Trashed
Breadcrumbs::for('users.trashed', function ($trail) {
    $trail->parent('users');
    $trail->push('Trashed', route('trashed.users'));
});


//// Home > Categories
Breadcrumbs::for('categories', function ($trail) {
    $trail->parent('home');
    $trail->push('Category', route('categories'));
});


// Home > Categories > New
Breadcrumbs::for('categories.create', function ($trail) {
    $trail->parent('categories');
    $trail->push('New', route('categories.create'));
});

// Home > Categories > Edit
Breadcrumbs::for('categories.edit', function ($trail, $user) {
    $trail->parent('categories');
    $trail->push('Edit', route('categories.edit', $user));
});


// Home > Categories > Show
Breadcrumbs::for('categories.show', function ($trail, $user) {
    $trail->parent('categories');
    $trail->push('Show', route('categories.show', $user));
});

// Home > Categories > Trashed
Breadcrumbs::for('categories.trashed', function ($trail) {
    $trail->parent('categories');
    $trail->push('Trashed', route('categories.trashed'));
});


//// Home > Products
Breadcrumbs::for('products', function ($trail) {
    $trail->parent('home');
    $trail->push('Product', route('products'));
});


// Home > Products > New
Breadcrumbs::for('products.create', function ($trail) {
    $trail->parent('products');
    $trail->push('New', route('products.create'));
});

// Home > Products > Edit
Breadcrumbs::for('products.edit', function ($trail, $user) {
    $trail->parent('products');
    $trail->push('Edit', route('products.edit', $user));
});


// Home > Products > Show
Breadcrumbs::for('products.show', function ($trail, $user) {
    $trail->parent('products');
    $trail->push('Show', route('products.show', $user));
});

// Home > Categories > Trashed
Breadcrumbs::for('products.trashed', function ($trail) {
    $trail->parent('products');
    $trail->push('Trashed', route('products.trashed'));
});




//// Home > Clients
Breadcrumbs::for('clients', function ($trail) {
    $trail->parent('home');
    $trail->push('Clientes', route('clients'));
});


// Home > Clients > New
Breadcrumbs::for('clients.create', function ($trail) {
    $trail->parent('clients');
    $trail->push('New', route('clients.create'));
});

// Home > Clients > Edit
Breadcrumbs::for('clients.edit', function ($trail, $user) {
    $trail->parent('clients');
    $trail->push('Edit', route('clients.edit', $user));
});


// Home > Clients > Show
Breadcrumbs::for('clients.show', function ($trail, $user) {
    $trail->parent('clients');
    $trail->push('Show', route('clients.show', $user));
});






//// Home > Orders
Breadcrumbs::for('orders', function ($trail) {
    $trail->parent('home');
    $trail->push('Ordens', route('orders'));
});


// Home > Clients > New
Breadcrumbs::for('orders.create', function ($trail) {
    $trail->parent('orders');
    $trail->push('New', route('orders.create'));
});

// Home > Clients > Edit
Breadcrumbs::for('orders.edit', function ($trail, $user) {
    $trail->parent('orders');
    $trail->push('Edit', route('orders.edit', $user));
});


// Home > Clients > Show
Breadcrumbs::for('orders.show', function ($trail, $user) {
    $trail->parent('orders');
    $trail->push('Show', route('orders.show', $user));
});

