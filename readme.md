# Laravel Event Tracker

This package allows you to easily track events in your application 
and all you have to do is add a trait. At the moment, it tracks
`creates`, `updates` and `deletes` and stores the `before` and `after`
in your database table along with the authenticated users
`id` with a simple description like `created_user` or 
`deleted_file`, etc...

# Installation

The first step in installing this package is to use Composer to 
add the package to your project.

```
composer require devoptn/event-tracking
```

Since this package is setup for auto-discovery by Laravel, now
we can run the migration to create the database table.

```
php artisan migrate
```

Finally, on any model you would like to track, all we need to 
do is add and use the trait.

<pre>
namespace App;

<b>use DevOption\EventTracking\EventTracking;</b>
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    <b>use EventTracking;</b>

    ...

</pre>

And that's all! 

Any event that happens on any model you enabled tracking 
for will now log `create`, `update` and `delete` events 
to your database in the `event_tracking` table.


