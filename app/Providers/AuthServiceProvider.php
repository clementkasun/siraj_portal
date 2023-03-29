<?php

namespace App\Providers;

use App\Models\RolePrivillage;
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

        //Define Gate Privillages for the users
        Gate::define('create-user', function ($user) {
            $role_privillages =RolePrivillage::where('role_id', $user->role_id)->with('Privillage')->get();
            if (isset($role_privillages) && $user->status == 'Active') {
                foreach ($role_privillages as $role_privillage) {
                    if (isset($role_privillage)) {
                        if ($role_privillage->Privillage->name == 'User' && $role_privillage->is_create == 1) {
                            return true;
                        }
                    }
                }
            }
        });
        Gate::define('update-user', function ($user) {
            $role_privillages =RolePrivillage::where('role_id', $user->role_id)->with('Privillage')->get();
            if (isset($role_privillages) && $user->status == 'Active') {
                foreach ($role_privillages as $role_privillage) {
                    if (isset($role_privillage)) {
                        if ($role_privillage->Privillage->name == 'User' && $role_privillage->is_update == 1) {
                            return true;
                        }
                    }
                }
            }
        });
        Gate::define('delete-user', function ($user) {
            $role_privillages =RolePrivillage::where('role_id', $user->role_id)->with('Privillage')->get();
            if (isset($role_privillages) && $user->status == 'Active') {
                foreach ($role_privillages as $role_privillage) {
                    if (isset($role_privillage)) {
                        if ($role_privillage->Privillage->name == 'User' && $role_privillage->is_delete == 1) {
                            return true;
                        }
                    }
                }
            }
        });
        Gate::define('view-user', function ($user) {
            $role_privillages =RolePrivillage::where('role_id', $user->role_id)->with('Privillage')->get();
            if (isset($role_privillages) && $user->status == 'Active') {
                foreach ($role_privillages as $role_privillage) {
                    if (isset($role_privillage)) {
                        if ($role_privillage->Privillage->name == 'User' && $role_privillage->is_read == 1) {
                            return true;
                        }
                    }
                }
            }
        });

        //Define Gate Privillages for the online applicants
        Gate::define('create-online-applicant', function ($user) {
            // $role_privillages =RolePrivillage::where('role_id', $user->role_id)->with('Privillage')->get();
            // if (isset($role_privillages)) {
            //     foreach ($role_privillages as $role_privillage) {
            //         if ($role_privillage->Privillage->name == 'OnlineApplicant' && $role_privillage->is_create == 1) {
            //             return true;
            //         }
            //     }
            // }
            return true;
        });
        Gate::define('update-online-applicant', function ($user) {
            $role_privillages =RolePrivillage::where('role_id', $user->role_id)->with('Privillage')->get();
            if (isset($role_privillages) && $user->status == 'Active') {
                foreach ($role_privillages as $role_privillage) {
                    if (isset($role_privillage)) {
                        if ($role_privillage->Privillage->name == 'OnlineApplicant' && $role_privillage->is_update == 1) {
                            return true;
                        }
                    }
                }
            }
        });
        Gate::define('delete-online-applicant', function ($user) {
            $role_privillages =RolePrivillage::where('role_id', $user->role_id)->with('Privillage')->get();
            if (isset($role_privillages) && $user->status == 'Active') {
                foreach ($role_privillages as $role_privillage) {
                    if (isset($role_privillage)) {
                        if ($role_privillage->Privillage->name == 'OnlineApplicant' && $role_privillage->is_delete == 1) {
                            return true;
                        }
                    }
                }
            }
        });
        Gate::define('view-online-applicant', function ($user) {
            $role_privillages =RolePrivillage::where('role_id', $user->role_id)->with('Privillage')->get();
            if (isset($role_privillages) && $user->status == 'Active') {
                foreach ($role_privillages as $role_privillage) {
                    if (isset($role_privillage)) {
                        if ($role_privillage->Privillage->name == 'OnlineApplicant' && $role_privillage->is_read == 1) {
                            return true;
                        }
                    }
                }
            }
        });

        //Define Gate Privillages for the application staff response
        Gate::define('create-application-staff-resp', function ($user) {
            $role_privillages =RolePrivillage::where('role_id', $user->role_id)->with('Privillage')->get();
            if (isset($role_privillages) && $user->status == 'Active') {
                foreach ($role_privillages as $role_privillage) {
                    if (isset($role_privillage)) {
                        if ($role_privillage->Privillage->name == 'ApplicationStaffResponse' && $role_privillage->is_create == 1) {
                            return true;
                        }
                    }
                }
            }
        });
        Gate::define('update-application-staff-resp', function ($user) {
            $role_privillages =RolePrivillage::where('role_id', $user->role_id)->with('Privillage')->get();
            if (isset($role_privillages) && $user->status == 'Active') {
                foreach ($role_privillages as $role_privillage) {
                    if (isset($role_privillage)) {
                        if ($role_privillage->Privillage->name == 'ApplicationStaffResponse' && $role_privillage->is_update == 1) {
                            return true;
                        }
                    }
                }
            }
        });
        Gate::define('delete-application-staff-resp', function ($user) {
            $role_privillages =RolePrivillage::where('role_id', $user->role_id)->with('Privillage')->get();
            if (isset($role_privillages) && $user->status == 'Active') {
                foreach ($role_privillages as $role_privillage) {
                    if (isset($role_privillage)) {
                        if ($role_privillage->Privillage->name == 'ApplicationStaffResponse' && $role_privillage->is_delete == 1) {
                            return true;
                        }
                    }
                }
            }
        });
        Gate::define('view-application-staff-resp', function ($user) {
            $role_privillages =RolePrivillage::where('role_id', $user->role_id)->with('Privillage')->get();
            if (isset($role_privillages) && $user->status == 'Active') {
                foreach ($role_privillages as $role_privillage) {
                    if (isset($role_privillage)) {
                        if ($role_privillage->Privillage->name == 'ApplicationStaffResponse' && $role_privillage->is_read == 1) {
                            return true;
                        }
                    }
                }
            }
        });

        //Define Gate Privillages for the offline applicants
        Gate::define('create-offline-applicant', function ($user) {
            $role_privillages =RolePrivillage::where('role_id', $user->role_id)->with('Privillage')->get();
            if (isset($role_privillages) && $user->status == 'Active') {
                foreach ($role_privillages as $role_privillage) {
                    if (isset($role_privillage)) {
                        if ($role_privillage->Privillage->name == 'OfflineApplicant' && $role_privillage->is_create == 1) {
                            return true;
                        }
                    }
                }
            }
        });
        Gate::define('update-offline-applicant', function ($user) {
            $role_privillages =RolePrivillage::where('role_id', $user->role_id)->with('Privillage')->get();
            if (isset($role_privillages) && $user->status == 'Active') {
                foreach ($role_privillages as $role_privillage) {
                    if (isset($role_privillage)) {
                        if ($role_privillage->Privillage->name == 'OfflineApplicant' && $role_privillage->is_update == 1) {
                            return true;
                        }
                    }
                }
            }
        });
        Gate::define('delete-offline-applicant', function ($user) {
            $role_privillages =RolePrivillage::where('role_id', $user->role_id)->with('Privillage')->get();
            if (isset($role_privillages) && $user->status == 'Active') {
                foreach ($role_privillages as $role_privillage) {
                    if (isset($role_privillage)) {
                        if ($role_privillage->Privillage->name == 'OfflineApplicant' && $role_privillage->is_delete == 1) {
                            return true;
                        }
                    }
                }
            }
        });
        Gate::define('view-offline-applicant', function ($user) {
            $role_privillages =RolePrivillage::where('role_id', $user->role_id)->with('Privillage')->get();
            if (isset($role_privillages) && $user->status == 'Active') {
                foreach ($role_privillages as $role_privillage) {
                    if (isset($role_privillage)) {
                        if ($role_privillage->Privillage->name == 'OfflineApplicant' && $role_privillage->is_read == 1) {
                            return true;
                        }
                    }
                }
            }
        });

        //Define Gate Privillages for the phone numbers
        Gate::define('create-phone-number', function ($user) {
            $role_privillages =RolePrivillage::where('role_id', $user->role_id)->with('Privillage')->get();
            if (isset($role_privillages) && $user->status == 'Active') {
                foreach ($role_privillages as $role_privillage) {
                    if (isset($role_privillage)) {
                        if ($role_privillage->Privillage->name == 'PhoneNumber' && $role_privillage->is_create == 1) {
                            return true;
                        }
                    }
                }
            }
        });
        Gate::define('update-phone-number', function ($user) {
            $role_privillages =RolePrivillage::where('role_id', $user->role_id)->with('Privillage')->get();
            if (isset($role_privillages) && $user->status == 'Active') {
                foreach ($role_privillages as $role_privillage) {
                    if (isset($role_privillage)) {
                        if ($role_privillage->Privillage->name == 'PhoneNumber' && $role_privillage->is_update == 1) {
                            return true;
                        }
                    }
                }
            }
        });
        Gate::define('delete-phone-number', function ($user) {
            $role_privillages =RolePrivillage::where('role_id', $user->role_id)->with('Privillage')->get();
            if (isset($role_privillages) && $user->status == 'Active') {
                foreach ($role_privillages as $role_privillage) {
                    if (isset($role_privillage)) {
                        if ($role_privillage->Privillage->name == 'PhoneNumber' && $role_privillage->is_delete == 1) {
                            return true;
                        }
                    }
                }
            }
        });
        Gate::define('view-phone-number', function ($user) {
            $role_privillages =RolePrivillage::where('role_id', $user->role_id)->with('Privillage')->get();
            if (isset($role_privillages) && $user->status == 'Active') {
                foreach ($role_privillages as $role_privillage) {
                    if (isset($role_privillage)) {
                        if ($role_privillage->Privillage->name == 'PhoneNumber' && $role_privillage->is_read == 1) {
                            return true;
                        }
                    }
                }
            }
        });

        //Define Gate Privillages for the phone number reponses
        Gate::define('create-phone-number-resp', function ($user) {
            $role_privillages =RolePrivillage::where('role_id', $user->role_id)->with('Privillage')->get();
            if (isset($role_privillages) && $user->status == 'Active') {
                foreach ($role_privillages as $role_privillage) {
                    if (isset($role_privillage)) {
                        if ($role_privillage->Privillage->name == 'PhoneNumberResponse' && $role_privillage->is_create == 1) {
                            return true;
                        }
                    }
                }
            }
        });
        Gate::define('update-phone-number-resp', function ($user) {
            $role_privillages =RolePrivillage::where('role_id', $user->role_id)->with('Privillage')->get();
            if (isset($role_privillages) && $user->status == 'Active') {
                foreach ($role_privillages as $role_privillage) {
                    if (isset($role_privillage)) {
                        if ($role_privillage->Privillage->name == 'PhoneNumberResponse' && $role_privillage->is_update == 1) {
                            return true;
                        }
                    }
                }
            }
        });
        Gate::define('delete-phone-number-resp', function ($user) {
            $role_privillages =RolePrivillage::where('role_id', $user->role_id)->with('Privillage')->get();
            if (isset($role_privillages) && $user->status == 'Active') {
                foreach ($role_privillages as $role_privillage) {
                    if (isset($role_privillage)) {
                        if ($role_privillage->Privillage->name == 'PhoneNumberResponse' && $role_privillage->is_delete == 1) {
                            return true;
                        }
                    }
                }
            }
        });
        Gate::define('view-phone-number-resp', function ($user) {
            $role_privillages =RolePrivillage::where('role_id', $user->role_id)->with('Privillage')->get();
            if (isset($role_privillages) && $user->status == 'Active') {
                foreach ($role_privillages as $role_privillage) {
                    if (isset($role_privillage)) {
                        if ($role_privillage->Privillage->name == 'PhoneNumberResponse' && $role_privillage->is_read == 1) {
                            return true;
                        }
                    }
                }
            }
        });

        //Define Gate Privillages for the contact us
        Gate::define('create-contact-us', function ($user) {
            return true;
        });
        Gate::define('update-contact-us', function ($user) {
            $role_privillages =RolePrivillage::where('role_id', $user->role_id)->with('Privillage')->get();
            if (isset($role_privillages) && $user->status == 'Active') {
                foreach ($role_privillages as $role_privillage) {
                    if (isset($role_privillage)) {
                        if ($role_privillage->Privillage->name == 'ContactUs' && $role_privillage->is_update == 1) {
                            return true;
                        }
                    }
                }
            }
        });
        Gate::define('delete-contact-us', function ($user) {
            $role_privillages =RolePrivillage::where('role_id', $user->role_id)->with('Privillage')->get();
            if (isset($role_privillages) && $user->status == 'Active') {
                foreach ($role_privillages as $role_privillage) {
                    if (isset($role_privillage)) {
                        if ($role_privillage->Privillage->name == 'ContactUs' && $role_privillage->is_delete == 1) {
                            return true;
                        }
                    }
                }
            }
        });
        Gate::define('view-contact-us', function ($user) {
            $role_privillages =RolePrivillage::where('role_id', $user->role_id)->with('Privillage')->get();
            if (isset($role_privillages) && $user->status == 'Active') {
                foreach ($role_privillages as $role_privillage) {
                    if (isset($role_privillage)) {
                        if ($role_privillage->Privillage->name == 'ContactUs' && $role_privillage->is_read == 1) {
                            return true;
                        }
                    }
                }
            }
        });

        //Define Gate Privillages for the contact us response
        Gate::define('create-contact-us-resp', function ($user) {
            $role_privillages =RolePrivillage::where('role_id', $user->role_id)->with('Privillage')->get();
            if (isset($role_privillages) && $user->status == 'Active') {
                foreach ($role_privillages as $role_privillage) {
                    if (isset($role_privillage)) {
                        if ($role_privillage->Privillage->name == 'ContactUsResponse' && $role_privillage->is_create == 1) {
                            return true;
                        }
                    }
                }
            }
        });
        Gate::define('update-contact-us-resp', function ($user) {
            $role_privillages =RolePrivillage::where('role_id', $user->role_id)->with('Privillage')->get();
            if (isset($role_privillages) && $user->status == 'Active') {
                foreach ($role_privillages as $role_privillage) {
                    if (isset($role_privillage)) {
                        if ($role_privillage->Privillage->name == 'ContactUsResponse' && $role_privillage->is_update == 1) {
                            return true;
                        }
                    }
                }
            }
        });
        Gate::define('delete-contact-us-resp', function ($user) {
            $role_privillages =RolePrivillage::where('role_id', $user->role_id)->with('Privillage')->get();
            if (isset($role_privillages) && $user->status == 'Active') {
                foreach ($role_privillages as $role_privillage) {
                    if (isset($role_privillage)) {
                        if ($role_privillage->Privillage->name == 'ContactUsResponse' && $role_privillage->is_delete == 1) {
                            return true;
                        }
                    }
                }
            }
        });
        Gate::define('view-contact-us-resp', function ($user) {
            $role_privillages =RolePrivillage::where('role_id', $user->role_id)->with('Privillage')->get();
            if (isset($role_privillages) && $user->status == 'Active') {
                foreach ($role_privillages as $role_privillage) {
                    if (isset($role_privillage)) {
                        if ($role_privillage->Privillage->name == 'ContactUsResponse' && $role_privillage->is_read == 1) {
                            return true;
                        }
                    }
                }
            }
        });

        //Define Gate Privillages for the blog post
        Gate::define('create-blog-post', function ($user) {
            $role_privillages =RolePrivillage::where('role_id', $user->role_id)->with('Privillage')->get();
            if (isset($role_privillages) && $user->status == 'Active') {
                foreach ($role_privillages as $role_privillage) {
                    if (isset($role_privillage)) {
                        if ($role_privillage->Privillage->name == 'BlogPost' && $role_privillage->is_create == 1) {
                            return true;
                        }
                    }
                }
            }
        });
        Gate::define('update-blog-post', function ($user) {
            $role_privillages =RolePrivillage::where('role_id', $user->role_id)->with('Privillage')->get();
            if (isset($role_privillages) && $user->status == 'Active') {
                foreach ($role_privillages as $role_privillage) {
                    if (isset($role_privillage)) {
                        if ($role_privillage->Privillage->name == 'BlogPost' && $role_privillage->is_update == 1) {
                            return true;
                        }
                    }
                }
            }
        });
        Gate::define('delete-blog-post', function ($user) {
            $role_privillages =RolePrivillage::where('role_id', $user->role_id)->with('Privillage')->get();
            if (isset($role_privillages) && $user->status == 'Active') {
                foreach ($role_privillages as $role_privillage) {
                    if (isset($role_privillage)) {
                        if ($role_privillage->Privillage->name == 'BlogPost' && $role_privillage->is_delete == 1) {
                            return true;
                        }
                    }
                }
            }
        });
        Gate::define('view-blog-post', function ($user) {
            $role_privillages =RolePrivillage::where('role_id', $user->role_id)->with('Privillage')->get();
            if (isset($role_privillages) && $user->status == 'Active') {
                foreach ($role_privillages as $role_privillage) {
                    if (isset($role_privillage)) {
                        if ($role_privillage->Privillage->name == 'BlogPost' && $role_privillage->is_read == 1) {
                            return true;
                        }
                    }
                }
            }
        });

        //Define Gate Privillages for the vacancy
        Gate::define('create-vacancy', function ($user) {
            $role_privillages =RolePrivillage::where('role_id', $user->role_id)->with('Privillage')->get();
            if (isset($role_privillages) && $user->status == 'Active') {
                foreach ($role_privillages as $role_privillage) {
                    if (isset($role_privillage)) {
                        if ($role_privillage->Privillage->name == 'Vacancy' && $role_privillage->is_create == 1) {
                            return true;
                        }
                    }
                }
            }
        });
        Gate::define('update-vacancy', function ($user) {
            $role_privillages =RolePrivillage::where('role_id', $user->role_id)->with('Privillage')->get();
            if (isset($role_privillages) && $user->status == 'Active') {
                foreach ($role_privillages as $role_privillage) {
                    if (isset($role_privillage)) {
                        if ($role_privillage->Privillage->name == 'Vacancy' && $role_privillage->is_update == 1) {
                            return true;
                        }
                    }
                }
            }
        });
        Gate::define('delete-vacancy', function ($user) {
            $role_privillages =RolePrivillage::where('role_id', $user->role_id)->with('Privillage')->get();
            if (isset($role_privillages) && $user->status == 'Active') {
                foreach ($role_privillages as $role_privillage) {
                    if (isset($role_privillage)) {
                        if ($role_privillage->Privillage->name == 'Vacancy' && $role_privillage->is_delete == 1) {
                            return true;
                        }
                    }
                }
            }
        });
        Gate::define('view-vacancy', function ($user) {
            // $role_privillages =RolePrivillage::where('role_id', $user->role_id)->with('Privillage')->get();
            // if (isset($role_privillages)) {
            //     foreach ($role_privillages as $role_privillage) {
            //         if ($role_privillage->Privillage->name == 'Vacancy' && $role_privillage->is_read == 1) {
            //             return true;
            //         }
            //     }
            // }
            return true;
        });

        //Define Gate Privillages for the commission
        Gate::define('create-commission', function ($user) {
            $role_privillages =RolePrivillage::where('role_id', $user->role_id)->with('Privillage')->get();
            if (isset($role_privillages) && $user->status == 'Active') {
                foreach ($role_privillages as $role_privillage) {
                    if (isset($role_privillage)) {
                        if ($role_privillage->Privillage->name == 'Commission' && $role_privillage->is_create == 1) {
                            return true;
                        }
                    }
                }
            }
        });
        Gate::define('update-commission', function ($user) {
            $role_privillages =RolePrivillage::where('role_id', $user->role_id)->with('Privillage')->get();
            if (isset($role_privillages) && $user->status == 'Active') {
                foreach ($role_privillages as $role_privillage) {
                    if (isset($role_privillage)) {
                        if ($role_privillage->Privillage->name == 'Commission' && $role_privillage->is_update == 1) {
                            return true;
                        }
                    }
                }
            }
        });
        Gate::define('delete-commission', function ($user) {
            $role_privillages =RolePrivillage::where('role_id', $user->role_id)->with('Privillage')->get();
            if (isset($role_privillages) && $user->status == 'Active') {
                foreach ($role_privillages as $role_privillage) {
                    if (isset($role_privillage)) {
                        if ($role_privillage->Privillage->name == 'Commission' && $role_privillage->is_delete == 1) {
                            return true;
                        }
                    }
                }
            }
        });
        Gate::define('view-commission', function ($user) {
            $role_privillages =RolePrivillage::where('role_id', $user->role_id)->with('Privillage')->get();
            if (isset($role_privillages) && $user->status == 'Active') {
                foreach ($role_privillages as $role_privillage) {
                    if (isset($role_privillage)) {
                        if ($role_privillage->Privillage->name == 'Commission' && $role_privillage->is_read == 1) {
                            return true;
                        }
                    }
                }
            }
        });


        //Define Gate Privillages for the previous employeements
        Gate::define('create-previous-emp', function ($user) {
            $role_privillages =RolePrivillage::where('role_id', $user->role_id)->with('Privillage')->get();
            if (isset($role_privillages) && $user->status == 'Active') {
                foreach ($role_privillages as $role_privillage) {
                    if (isset($role_privillage)) {
                        if ($role_privillage->Privillage->name == 'PreviousEmployeement' && $role_privillage->is_create == 1) {
                            return true;
                        }
                    }
                }
            }
        });
        Gate::define('update-previous-emp', function ($user) {
            $role_privillages =RolePrivillage::where('role_id', $user->role_id)->with('Privillage')->get();
            if (isset($role_privillages) && $user->status == 'Active') {
                foreach ($role_privillages as $role_privillage) {
                    if (isset($role_privillage)) {
                        if ($role_privillage->Privillage->name == 'PreviousEmployeement' && $role_privillage->is_update == 1) {
                            return true;
                        }
                    }
                }
            }
        });
        Gate::define('delete-previous-emp', function ($user) {
            $role_privillages =RolePrivillage::where('role_id', $user->role_id)->with('Privillage')->get();
            if (isset($role_privillages) && $user->status == 'Active') {
                foreach ($role_privillages as $role_privillage) {
                    if (isset($role_privillage)) {
                        if ($role_privillage->Privillage->name == 'PreviousEmployeement' && $role_privillage->is_delete == 1) {
                            return true;
                        }
                    }
                }
            }
        });
        Gate::define('view-previous-emp', function ($user) {
            $role_privillages =RolePrivillage::where('role_id', $user->role_id)->with('Privillage')->get();
            if (isset($role_privillages) && $user->status == 'Active') {
                foreach ($role_privillages as $role_privillage) {
                    if (isset($role_privillage)) {
                        if ($role_privillage->Privillage->name == 'PreviousEmployeement' && $role_privillage->is_read == 1) {
                            return true;
                        }
                    }
                }
            }
        });

        //Define Gate Privillages for the applicant languages
        Gate::define('create-applicant-language', function ($user) {
            $role_privillages =RolePrivillage::where('role_id', $user->role_id)->with('Privillage')->get();
            if (isset($role_privillages) && $user->status == 'Active') {
                foreach ($role_privillages as $role_privillage) {
                    if (isset($role_privillage)) {
                        if ($role_privillage->Privillage->name == 'ApplicantLanguage' && $role_privillage->is_create == 1) {
                            return true;
                        }
                    }
                }
            }
        });
        Gate::define('update-applicant-language', function ($user) {
            $role_privillages =RolePrivillage::where('role_id', $user->role_id)->with('Privillage')->get();
            if (isset($role_privillages) && $user->status == 'Active') {
                foreach ($role_privillages as $role_privillage) {
                    if (isset($role_privillage)) {
                        if ($role_privillage->Privillage->name == 'ApplicantLanguage' && $role_privillage->is_update == 1) {
                            return true;
                        }
                    }
                }
            }
        });
        Gate::define('delete-applicant-language', function ($user) {
            $role_privillages =RolePrivillage::where('role_id', $user->role_id)->with('Privillage')->get();
            if (isset($role_privillages) && $user->status == 'Active') {
                foreach ($role_privillages as $role_privillage) {
                    if (isset($role_privillage)) {
                        if ($role_privillage->Privillage->name == 'ApplicantLanguage' && $role_privillage->is_delete == 1) {
                            return true;
                        }
                    }
                }
            }
        });
        Gate::define('view-applicant-language', function ($user) {
            $role_privillages =RolePrivillage::where('role_id', $user->role_id)->with('Privillage')->get();
            if (isset($role_privillages) && $user->status == 'Active') {
                foreach ($role_privillages as $role_privillage) {
                    if (isset($role_privillage)) {
                        if ($role_privillage->Privillage->name == 'ApplicantLanguage' && $role_privillage->is_read == 1) {
                            return true;
                        }
                    }
                }
            }
        });
        Gate::define('create-online-applicant-resp', function ($user) {
            $role_privillages =RolePrivillage::where('role_id', $user->role_id)->with('Privillage')->get();
            if (isset($role_privillages) && $user->status == 'Active') {
                foreach ($role_privillages as $role_privillage) {
                    if (isset($role_privillage)) {
                        if ($role_privillage->Privillage->name == 'OnlineApplicantResponse' && $role_privillage->is_create == 1) {
                            return true;
                        }
                    }
                }
            }
        });
        Gate::define('view-online-applicant-resp', function ($user) {
            $role_privillages =RolePrivillage::where('role_id', $user->role_id)->with('Privillage')->get();
            if (isset($role_privillages) && $user->status == 'Active') {
                foreach ($role_privillages as $role_privillage) {
                    if (isset($role_privillage)) {
                        if ($role_privillage->Privillage->name == 'OnlineApplicantResponse' && $role_privillage->is_read == 1) {
                            return true;
                        }
                    }
                }
            }
        });

        // Gate::define('view-log-routes', function ($user) {
        //     $role_privillages =RolePrivillage::where('role_id', $user->role_id)->with('Privillage')->get();
        //     if (isset($role_privillages) && $user->status == 'Active') {
        //         foreach ($role_privillages as $role_privillage) {
        //             if (isset($role_privillage)) {
        //                 if ($role_privillage->Privillage->name == 'ViewLogRoute' && $role_privillage->is_read == 1) {
        //                     return true;
        //                 }
        //             }
        //         }
        //     }
        // });
    }
}
