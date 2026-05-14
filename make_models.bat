php artisan make:migration add_type_and_room_id_to_events_table --table=events
php artisan make:model Profile -m
php artisan make:model Skill -m
php artisan make:migration create_user_skill_table
php artisan make:migration create_user_need_table
php artisan make:model Connection -m
php artisan make:model VentureRoom -m
php artisan make:model RoomMember -m
php artisan make:model Pitch -m
php artisan make:controller ProfileMatrixController
