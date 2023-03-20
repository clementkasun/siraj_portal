<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('create-user', function ($user) {
            $role_privillages = $user->with(['Role', 'Role.RolePrivillage', 'Role.RolePrivillage.Privillage'])->first()['Role']['RolePrivillage'];
            if (isset($role_privillages)) {
                foreach ($role_privillages as $role_privillage) {
                    if ($role_privillage->privillage[0]->name == 'vacancy' && $role_privillage->is_create == 1) {
                        return true;
                    }
                }
            }
        });
        Gate::define('update-user', function ($user) {
            $role_privillages = $user->with(['Role', 'Role.RolePrivillage', 'Role.RolePrivillage.Privillage'])->first()['Role']['RolePrivillage'];
            if (isset($role_privillages)) {
                foreach ($role_privillages as $role_privillage) {
                    if ($role_privillage->privillage[0]->name == 'user' && $role_privillage->is_update == 1) {
                        return true;
                    }
                }
            }
        });
        Gate::define('delete-user', function ($user) {
            $role_privillages = $user->with(['Role', 'Role.RolePrivillage', 'Role.RolePrivillage.Privillage'])->first()['Role']['RolePrivillage'];
            if (isset($role_privillages)) {
                foreach ($role_privillages as $role_privillage) {
                    if ($role_privillage->privillage[0]->name == 'user' && $role_privillage->is_delete == 1) {
                        return true;
                    }
                }
            }
        });
        Gate::define('view-user', function ($user) {
            $role_privillages = $user->with(['Role', 'Role.RolePrivillage', 'Role.RolePrivillage.Privillage'])->first()['Role']['RolePrivillage'];
            if (isset($role_privillages)) {
                foreach ($role_privillages as $role_privillage) {
                    if ($role_privillage->privillage[0]->name == 'user' && $role_privillage->is_read == 1) {
                        return true;
                    }
                }
            }
        });
        Gate::define('create-role', function ($user) {
            $role_privillages = $user->with(['Role', 'Role.RolePrivillage', 'Role.RolePrivillage.Privillage'])->first()['Role']['RolePrivillage'];
            if (isset($role_privillages)) {
                foreach ($role_privillages as $role_privillage) {
                    if ($role_privillage->privillage[0]->name == 'role' && $role_privillage->is_create == 1) {
                        return true;
                    }
                }
            }
        });
        Gate::define('update-role', function ($user) {
            $role_privillages = $user->with(['Role', 'Role.RolePrivillage', 'Role.RolePrivillage.Privillage'])->first()['Role']['RolePrivillage'];
            if (isset($role_privillages)) {
                foreach ($role_privillages as $role_privillage) {
                    if ($role_privillage->privillage[0]->name == 'role' && $role_privillage->is_update == 1) {
                        return true;
                    }
                }
            }
        });
        Gate::define('delete-role', function ($user) {
            $role_privillages = $user->with(['Role', 'Role.RolePrivillage', 'Role.RolePrivillage.Privillage'])->first()['Role']['RolePrivillage'];
            if (isset($role_privillages)) {
                foreach ($role_privillages as $role_privillage) {
                    if ($role_privillage->privillage[0]->name == 'role' && $role_privillage->is_delete == 1) {
                        return true;
                    }
                }
            }
        });
        Gate::define('view-role', function ($user) {
            $role_privillages = $user->with(['Role', 'Role.RolePrivillage', 'Role.RolePrivillage.Privillage'])->first()['Role']['RolePrivillage'];
            if (isset($role_privillages)) {
                foreach ($role_privillages as $role_privillage) {
                    if ($role_privillage->privillage[0]->name == 'role' && $role_privillage->is_read == 1) {
                        return true;
                    }
                }
            }
        });
        Gate::define('create-level', function ($user) {
            $role_privillages = $user->with(['Role', 'Role.RolePrivillage', 'Role.RolePrivillage.Privillage'])->first()['Role']['RolePrivillage'];
            if (isset($role_privillages)) {
                foreach ($role_privillages as $role_privillage) {
                    if ($role_privillage->privillage[0]->name == 'level' && $role_privillage->is_creat == 1) {
                        return true;
                    }
                }
            }
        });
        Gate::define('update-level', function ($user) {
            $role_privillages = $user->with(['Role', 'Role.RolePrivillage', 'Role.RolePrivillage.Privillage'])->first()['Role']['RolePrivillage'];
            if (isset($role_privillages)) {
                foreach ($role_privillages as $role_privillage) {
                    if ($role_privillage->privillage[0]->name == 'level' && $role_privillage->is_update == 1) {
                        return true;
                    }
                }
            }
        });
        Gate::define('delete-level', function ($user) {
            $role_privillages = $user->with(['Role', 'Role.RolePrivillage', 'Role.RolePrivillage.Privillage'])->first()['Role']['RolePrivillage'];
            if (isset($role_privillages)) {
                foreach ($role_privillages as $role_privillage) {
                    if ($role_privillage->privillage[0]->name == 'level' && $role_privillage->is_delete == 1) {
                        return true;
                    }
                }
            }
        });
        Gate::define('create-privillage', function ($user) {
            $role_privillages = $user->with(['Role', 'Role.RolePrivillage', 'Role.RolePrivillage.Privillage'])->first()['Role']['RolePrivillage'];
            if (isset($role_privillages)) {
                foreach ($role_privillages as $role_privillage) {
                    if ($role_privillage->privillage[0]->name == 'privillage' && $role_privillage->is_update == 1) {
                        return true;
                    }
                }
            }
        });
        Gate::define('update-privillage', function ($user) {
            $role_privillages = $user->with(['Role', 'Role.RolePrivillage', 'Role.RolePrivillage.Privillage'])->first()['Role']['RolePrivillage'];
            if (isset($role_privillages)) {
                foreach ($role_privillages as $role_privillage) {
                    if ($role_privillage->privillage[0]->name == 'privillage' && $role_privillage->is_delete == 1) {
                        return true;
                    }
                }
            }
        });
        Gate::define('view-privillage', function ($user) {
            $role_privillages = $user->with(['Role', 'Role.RolePrivillage', 'Role.RolePrivillage.Privillage'])->first()['Role']['RolePrivillage'];
            if (isset($role_privillages)) {
                foreach ($role_privillages as $role_privillage) {
                    if ($role_privillage->privillage[0]->name == 'privillage' && $role_privillage->is_read == 1) {
                        return true;
                    }
                }
            }
        });
        Gate::define('create-candidate', function ($user) {
            $role_privillages = $user->with(['Role', 'Role.RolePrivillage', 'Role.RolePrivillage.Privillage'])->first()['Role']['RolePrivillage'];
            if (isset($role_privillages)) {
                foreach ($role_privillages as $role_privillage) {
                    if ($role_privillage->privillage[0]->name == 'candidate' && $role_privillage->is_create == 1) {
                        return true;
                    }
                }
            }
        });
        Gate::define('update-candidate', function ($user) {
            $role_privillages = $user->with(['Role', 'Role.RolePrivillage', 'Role.RolePrivillage.Privillage'])->first()['Role']['RolePrivillage'];
            if (isset($role_privillages)) {
                foreach ($role_privillages as $role_privillage) {
                    if ($role_privillage->privillage[0]->name == 'candidate' && $role_privillage->is_update == 1) {
                        return true;
                    }
                }
            }
        });
        Gate::define('delete-candidate', function ($user) {
            $role_privillages = $user->with(['Role', 'Role.RolePrivillage', 'Role.RolePrivillage.Privillage'])->first()['Role']['RolePrivillage'];
            if (isset($role_privillages)) {
                foreach ($role_privillages as $role_privillage) {
                    if ($role_privillage->privillage[0]->name == 'candidate' && $role_privillage->is_delete == 1) {
                        return true;
                    }
                }
            }
        });
        Gate::define('view-candidate', function ($user) {
            $role_privillages = $user->with(['Role', 'Role.RolePrivillage', 'Role.RolePrivillage.Privillage'])->first()['Role']['RolePrivillage'];
            if (isset($role_privillages)) {
                foreach ($role_privillages as $role_privillage) {
                    if ($role_privillage->privillage[0]->name == 'candidate' && $role_privillage->is_read == 1) {
                        return true;
                    }
                }
            }
        });
        Gate::define('create-contact', function ($user) {
            $role_privillages = $user->with(['Role', 'Role.RolePrivillage', 'Role.RolePrivillage.Privillage'])->first()['Role']['RolePrivillage'];
            if (isset($role_privillages)) {
                foreach ($role_privillages as $role_privillage) {
                    if ($role_privillage->privillage[0]->name == 'contact' && $role_privillage->is_create == 1) {
                        return true;
                    }
                }
            }
        });
        Gate::define('update-contact', function ($user) {
            $role_privillages = $user->with(['Role', 'Role.RolePrivillage', 'Role.RolePrivillage.Privillage'])->first()['Role']['RolePrivillage'];
            if (isset($role_privillages)) {
                foreach ($role_privillages as $role_privillage) {
                    if ($role_privillage->privillage[0]->name == 'contact' && $role_privillage->is_update == 1) {
                        return true;
                    }
                }
            }
        });
        Gate::define('delete-contact', function ($user) {
            $role_privillages = $user->with(['Role', 'Role.RolePrivillage', 'Role.RolePrivillage.Privillage'])->first()['Role']['RolePrivillage'];
            if (isset($role_privillages)) {
                foreach ($role_privillages as $role_privillage) {
                    if ($role_privillage->privillage[0]->name == 'contact' && $role_privillage->is_delete == 1) {
                        return true;
                    }
                }
            }
        });
        Gate::define('view-contact', function ($user) {
            $role_privillages = $user->with(['Role', 'Role.RolePrivillage', 'Role.RolePrivillage.Privillage'])->first()['Role']['RolePrivillage'];
            if (isset($role_privillages)) {
                foreach ($role_privillages as $role_privillage) {
                    if ($role_privillage->privillage[0]->name == 'contact' && $role_privillage->is_read == 1) {
                        return true;
                    }
                }
            }
        });
        Gate::define('create-contact-response', function ($user) {
            $role_privillages = $user->with(['Role', 'Role.RolePrivillage', 'Role.RolePrivillage.Privillage'])->first()['Role']['RolePrivillage'];
            if (isset($role_privillages)) {
                foreach ($role_privillages as $role_privillage) {
                    if ($role_privillage->privillage[0]->name == 'contact_response' && $role_privillage->is_create == 1) {
                        return true;
                    }
                }
            }
        });
        Gate::define('update-contact-response', function ($user) {
            $role_privillages = $user->with(['Role', 'Role.RolePrivillage', 'Role.RolePrivillage.Privillage'])->first()['Role']['RolePrivillage'];
            if (isset($role_privillages)) {
                foreach ($role_privillages as $role_privillage) {
                    if ($role_privillage->privillage[0]->name == 'contact_response' && $role_privillage->is_update == 1) {
                        return true;
                    }
                }
            }
        });
        Gate::define('delete-contact-response', function ($user) {
            $role_privillages = $user->with(['Role', 'Role.RolePrivillage', 'Role.RolePrivillage.Privillage'])->first()['Role']['RolePrivillage'];
            if (isset($role_privillages)) {
                foreach ($role_privillages as $role_privillage) {
                    if ($role_privillage->privillage[0]->name == 'contact_response' && $role_privillage->is_delete == 1) {
                        return true;
                    }
                }
            }
        });
        Gate::define('view-contact-response', function ($user) {
            $role_privillages = $user->with(['Role', 'Role.RolePrivillage', 'Role.RolePrivillage.Privillage'])->first()['Role']['RolePrivillage'];
            if (isset($role_privillages)) {
                foreach ($role_privillages as $role_privillage) {
                    if ($role_privillage->privillage[0]->name == 'contact_response' && $role_privillage->is_read == 1) {
                        return true;
                    }
                }
            }
        });
        Gate::define('create-candidate-response', function ($user) {
            $role_privillages = $user->with(['Role', 'Role.RolePrivillage', 'Role.RolePrivillage.Privillage'])->first()['Role']['RolePrivillage'];
            if (isset($role_privillages)) {
                foreach ($role_privillages as $role_privillage) {
                    if ($role_privillage->privillage[0]->name == 'candidate_response' && $role_privillage->is_create == 1) {
                        return true;
                    }
                }
            }
        });
        Gate::define('update-candidate-response', function ($user) {
            $role_privillages = $user->with(['Role', 'Role.RolePrivillage', 'Role.RolePrivillage.Privillage'])->first()['Role']['RolePrivillage'];
            if (isset($role_privillages)) {
                foreach ($role_privillages as $role_privillage) {
                    if ($role_privillage->privillage[0]->name == 'candidate_response' && $role_privillage->is_update == 1) {
                        return true;
                    }
                }
            }
        });
        Gate::define('delete-candidate-response', function ($user) {
            $role_privillages = $user->with(['Role', 'Role.RolePrivillage', 'Role.RolePrivillage.Privillage'])->first()['Role']['RolePrivillage'];
            if (isset($role_privillages)) {
                foreach ($role_privillages as $role_privillage) {
                    if ($role_privillage->privillage[0]->name == 'candidate_response' && $role_privillage->is_delete == 1) {
                        return true;
                    }
                }
            }
        });
        Gate::define('view-candidate-response', function ($user) {
            $role_privillages = $user->with(['Role', 'Role.RolePrivillage', 'Role.RolePrivillage.Privillage'])->first()['Role']['RolePrivillage'];
            if (isset($role_privillages)) {
                foreach ($role_privillages as $role_privillage) {
                    if ($role_privillage->privillage[0]->name == 'candidate_response' && $role_privillage->is_read == 1) {
                        return true;
                    }
                }
            }
        });
        Gate::define('create-vacancy', function ($user) {
            $role_privillages = $user->with(['Role', 'Role.RolePrivillage', 'Role.RolePrivillage.Privillage'])->first()['Role']['RolePrivillage'];
            if (isset($role_privillages)) {
                foreach ($role_privillages as $role_privillage) {
                    if ($role_privillage->privillage[0]->name == 'vacancy' && $role_privillage->is_create == 1) {
                        return true;
                    }
                }
            }
        });
        Gate::define('update-vacancy', function ($user) {
            $role_privillages = $user->with(['Role', 'Role.RolePrivillage', 'Role.RolePrivillage.Privillage'])->first()['Role']['RolePrivillage'];
            if (isset($role_privillages)) {
                foreach ($role_privillages as $role_privillage) {
                    if ($role_privillage->privillage[0]->name == 'vacancy' && $role_privillage->is_update == 1) {
                        return true;
                    }
                }
            }
        });
        Gate::define('delete-vacancy', function ($user) {
            $role_privillages = $user->with(['Role', 'Role.RolePrivillage', 'Role.RolePrivillage.Privillage'])->first()['Role']['RolePrivillage'];
            if (isset($role_privillages)) {
                foreach ($role_privillages as $role_privillage) {
                    if ($role_privillage->privillage[0]->name == 'vacancy' && $role_privillage->is_delete == 1) {
                        return true;
                    }
                }
            }
        });
        Gate::define('view-vacancy', function ($user) {
            $role_privillages = $user->with(['Role', 'Role.RolePrivillage', 'Role.RolePrivillage.Privillage'])->first()['Role']['RolePrivillage'];
            if (isset($role_privillages)) {
                foreach ($role_privillages as $role_privillage) {
                    if ($role_privillage->privillage[0]->name == 'vacancy' && $role_privillage->is_read == 1) {
                        return true;
                    }
                }
            }
        });
        Gate::define('create-applicant', function ($user) {
            $role_privillages = $user->with(['Role', 'Role.RolePrivillage', 'Role.RolePrivillage.Privillage'])->first()['Role']['RolePrivillage'];
            if (isset($role_privillages)) {
                foreach ($role_privillages as $role_privillage) {
                    if ($role_privillage->privillage[0]->name == 'applicant' && $role_privillage->is_create == 1) {
                        return true;
                    }
                }
            }
        });
        Gate::define('update-applicant', function ($user) {
            $role_privillages = $user->with(['Role', 'Role.RolePrivillage', 'Role.RolePrivillage.Privillage'])->first()['Role']['RolePrivillage'];
            if (isset($role_privillages)) {
                foreach ($role_privillages as $role_privillage) {
                    if ($role_privillage->privillage[0]->name == 'applicant' && $role_privillage->is_update == 1) {
                        return true;
                    }
                }
            }
        });
        Gate::define('delete-applicant', function ($user) {
            $role_privillages = $user->with(['Role', 'Role.RolePrivillage', 'Role.RolePrivillage.Privillage'])->first()['Role']['RolePrivillage'];
            if (isset($role_privillages)) {
                foreach ($role_privillages as $role_privillage) {
                    if ($role_privillage->privillage[0]->name == 'applicant' && $role_privillage->is_delete == 1) {
                        return true;
                    }
                }
            }
        });
        Gate::define('view-applicant', function ($user) {
            $role_privillages = $user->with(['Role', 'Role.RolePrivillage', 'Role.RolePrivillage.Privillage'])->first()['Role']['RolePrivillage'];
            if (isset($role_privillages)) {
                foreach ($role_privillages as $role_privillage) {
                    if ($role_privillage->privillage[0]->name == 'applicant' && $role_privillage->is_read == 1) {
                        return true;
                    }
                }
            }
        });
        Gate::define('create-application-staff-resp', function ($user) {
            $role_privillages = $user->with(['Role', 'Role.RolePrivillage', 'Role.RolePrivillage.Privillage'])->first()['Role']['RolePrivillage'];
            if (isset($role_privillages)) {
                foreach ($role_privillages as $role_privillage) {
                    if ($role_privillage->privillage[0]->name == 'application_staff_response' && $role_privillage->is_create == 1) {
                        return true;
                    }
                }
            }
        });
        Gate::define('update-application-staff-resp', function ($user) {
            $role_privillages = $user->with(['Role', 'Role.RolePrivillage', 'Role.RolePrivillage.Privillage'])->first()['Role']['RolePrivillage'];
            if (isset($role_privillages)) {
                foreach ($role_privillages as $role_privillage) {
                    if ($role_privillage->privillage[0]->name == 'application_staff_response' && $role_privillage->is_update == 1) {
                        return true;
                    }
                }
            }
        });
        Gate::define('delete-application-staff-resp', function ($user) {
            $role_privillages = $user->with(['Role', 'Role.RolePrivillage', 'Role.RolePrivillage.Privillage'])->first()['Role']['RolePrivillage'];
            if (isset($role_privillages)) {
                foreach ($role_privillages as $role_privillage) {
                    if ($role_privillage->privillage[0]->name == 'application_staff_response' && $role_privillage->is_delete == 1) {
                        return true;
                    }
                }
            }
        });
        Gate::define('view-application-staff-resp', function ($user) {
            $role_privillages = $user->with(['Role', 'Role.RolePrivillage', 'Role.RolePrivillage.Privillage'])->first()['Role']['RolePrivillage'];
            if (isset($role_privillages)) {
                foreach ($role_privillages as $role_privillage) {
                    if ($role_privillage->privillage[0]->name == 'application_staff_response' && $role_privillage->is_read == 1) {
                        return true;
                    }
                }
            }
        });
        Gate::define('create-blog-post', function ($user) {
            $role_privillages = $user->with(['Role', 'Role.RolePrivillage', 'Role.RolePrivillage.Privillage'])->first()['Role']['RolePrivillage'];
            if (isset($role_privillages)) {
                foreach ($role_privillages as $role_privillage) {
                    if ($role_privillage->privillage[0]->name == 'blog_post' && $role_privillage->is_create == 1) {
                        return true;
                    }
                }
            }
        });
        Gate::define('update-blog-post', function ($user) {
            $role_privillages = $user->with(['Role', 'Role.RolePrivillage', 'Role.RolePrivillage.Privillage'])->first()['Role']['RolePrivillage'];
            if (isset($role_privillages)) {
                foreach ($role_privillages as $role_privillage) {
                    if ($role_privillage->privillage[0]->name == 'blog_post' && $role_privillage->is_update == 1) {
                        return true;
                    }
                }
            }
        });
        Gate::define('delete-blog-post', function ($user) {
            $role_privillages = $user->with(['Role', 'Role.RolePrivillage', 'Role.RolePrivillage.Privillage'])->first()['Role']['RolePrivillage'];
            if (isset($role_privillages)) {
                foreach ($role_privillages as $role_privillage) {
                    if ($role_privillage->privillage[0]->name == 'blog_post' && $role_privillage->is_delete == 1) {
                        return true;
                    }
                }
            }
        });
        Gate::define('view-blog-post', function ($user) {
            $role_privillages = $user->with(['Role', 'Role.RolePrivillage', 'Role.RolePrivillage.Privillage'])->first()['Role']['RolePrivillage'];
            if (isset($role_privillages)) {
                foreach ($role_privillages as $role_privillage) {
                    if ($role_privillage->privillage[0]->name == 'blog_post' && $role_privillage->is_read == 1) {
                        return true;
                    }
                }
            }
        });
        Gate::define('create-blog-post-staff-response', function ($user) {
            $role_privillages = $user->with(['Role', 'Role.RolePrivillage', 'Role.RolePrivillage.Privillage'])->first()['Role']['RolePrivillage'];
            if (isset($role_privillages)) {
                foreach ($role_privillages as $role_privillage) {
                    if ($role_privillage->privillage[0]->name == 'blog_post_staff_response' && $role_privillage->is_create == 1) {
                        return true;
                    }
                }
            }
        });
        Gate::define('update-blog-post-staff-response', function ($user) {
            $role_privillages = $user->with(['Role', 'Role.RolePrivillage', 'Role.RolePrivillage.Privillage'])->first()['Role']['RolePrivillage'];
            if (isset($role_privillages)) {
                foreach ($role_privillages as $role_privillage) {
                    if ($role_privillage->privillage[0]->name == 'blog_post_staff_response' && $role_privillage->is_update == 1) {
                        return true;
                    }
                }
            }
        });
        Gate::define('delete-blog-post-staff-response', function ($user) {
            $role_privillages = $user->with(['Role', 'Role.RolePrivillage', 'Role.RolePrivillage.Privillage'])->first()['Role']['RolePrivillage'];
            if (isset($role_privillages)) {
                foreach ($role_privillages as $role_privillage) {
                    if ($role_privillage->privillage[0]->name == 'blog_post_staff_response' && $role_privillage->is_delete == 1) {
                        return true;
                    }
                }
            }
        });
        Gate::define('view-blog-post-staff-response', function ($user) {
            $role_privillages = $user->with(['Role', 'Role.RolePrivillage', 'Role.RolePrivillage.Privillage'])->first()['Role']['RolePrivillage'];
            if (isset($role_privillages)) {
                foreach ($role_privillages as $role_privillage) {
                    if ($role_privillage->privillage[0]->name == 'blog_post_staff_response' && $role_privillage->is_read == 1) {
                        return true;
                    }
                }
            }
        });
    }
}
