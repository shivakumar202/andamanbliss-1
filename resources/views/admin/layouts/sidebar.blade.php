<!-- Left Panel -->
<aside id="left-panel" class="left-panel">
  <nav class="navbar navbar-expand-sm navbar-default">
    <div id="main-menu" class="main-menu collapse navbar-collapse">
      <ul class="nav navbar-nav">
        @hasanyrole('admin|manager|telecaller|guide|driver')
        <li class="{{ request()->is('admin/home*') ? 'active' : '' }}">
          <a href="{{ url('admin/home') }}">
            <i class="menu-icon fa fa-laptop"></i>
            {{ __('Dashboard') }}
          </a>
        </li>
        @endhasanyrole

        @hasanyrole('admin|manager|telecaller|guide|driver')
        <li class="{{ request()->is('admin/push-notifications') ? 'active' : '' }}">
          <a href="{{ url('admin/push-notifications') }}">
            <i class="menu-icon fa fa-bell"></i>
            {{ __('Push Notifications') }}
          </a>
        </li>
        @endhasanyrole



        @hasanyrole('admin|manager|telecaller|guide|driver')
        <li class="menu-title">{{ __('Tour') }}</li>
        @endhasanyrole

        @hasanyrole('admin|manager|telecaller')
        <li class="menu-item-has-children dropdown {{ request()->is('admin/leads*') ? 'active show' : '' }}">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="menu-icon fa fa-th-list"></i>
            {{ __('Leads') }}
          </a>
          <ul class="sub-menu children dropdown-menu {{ request()->is('admin/leads*') ? 'show' : '' }}">
            <li class="{{ request()->is('admin/leads') ? 'active' : '' }}">
              <a href="{{ url('admin/leads') }}">
                <i class="fa fa-file-text"></i>
                {{ __('List') }}
              </a>
            </li>
            @hasanyrole('admin|manager')
            <li class="{{ request()->is('admin/leads/create') ? 'active' : '' }}">
              <a href="{{ url('admin/leads/create') }}">
                <i class="fa fa-file"></i>
                {{ __('New') }}
              </a>
            </li>
            <li class="{{ request()->is('admin/leads/import') ? 'active' : '' }}">
              <a href="{{ url('admin/leads/import') }}">
                <i class="fa fa-upload"></i>
                {{ __('Import') }}
              </a>
            </li>
            @endhasanyrole
          </ul>
        </li>
        @endhasanyrole

        @hasanyrole('admin|manager|telecaller|guide')
        <li class="menu-item-has-children dropdown {{ request()->is('admin/itineraries*') ? 'active show' : '' }}">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="menu-icon fa fa-list-alt"></i>
            {{ __('Itineraries') }}
          </a>
          <ul class="sub-menu children dropdown-menu {{ request()->is('admin/itineraries*') ? 'show' : '' }}">
            <li class="{{ request()->is('admin/itineraries') ? 'active' : '' }}">
              <a href="{{ url('admin/itineraries') }}">
                <i class="fa fa-file-text"></i>
                {{ __('List') }}
              </a>
            </li>
            @hasanyrole('admin|manager|telecaller')
            <li class="{{ request()->is('admin/itineraries/create') ? 'active' : '' }}">
              <a href="{{ url('admin/itineraries/create') }}">
                <i class="fa fa-file"></i>
                {{ __('New') }}
              </a>
            </li>
            @endhasanyrole
          </ul>
        </li>
        @endhasanyrole

        @hasanyrole('admin|manager|telecaller|guide')
        <li class="menu-item-has-children dropdown {{ request()->is('admin/invoices*') ? 'active show' : '' }}">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="menu-icon fa fa-credit-card-alt"></i>
            {{ __('Invoices') }}
          </a>
          <ul class="sub-menu children dropdown-menu {{ request()->is('admin/invoices*') ? 'show' : '' }}">
            <li class="{{ request()->is('admin/invoices') ? 'active' : '' }}">
              <a href="{{ url('admin/invoices') }}">
                <i class="fa fa-file-text"></i>
                {{ __('List') }}
              </a>
            </li>
            @hasanyrole('admin|manager')
            <li class="{{ request()->is('admin/invoices/create') ? 'active' : '' }}">
              <a href="{{ url('admin/invoices/create') }}">
                <i class="fa fa-file"></i>
                {{ __('New') }}
              </a>
            </li>
            @endhasanyrole
          </ul>
        </li>
        @endhasanyrole

        @hasanyrole('admin|manager|telecaller|guide')
        <li class="menu-item-has-children dropdown {{ request()->is('admin/ids*') ? 'active show' : '' }}">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="menu-icon fa fa-id-card"></i>
            {{ __('ID Proofs') }}
          </a>
          <ul class="sub-menu children dropdown-menu {{ request()->is('admin/ids*') ? 'show' : '' }}">
            <li class="{{ request()->is('admin/ids') ? 'active' : '' }}">
              <a href="{{ url('admin/ids') }}">
                <i class="fa fa-file-text"></i>
                {{ __('List') }}
              </a>
            </li>
            @hasanyrole('admin|manager|telecaller')
            <li class="{{ request()->is('admin/ids/create') ? 'active' : '' }}">
              <a href="{{ url('admin/ids/create') }}">
                <i class="fa fa-file"></i>
                {{ __('New') }}
              </a>
            </li>
            @endhasanyrole
          </ul>
        </li>
        @endhasanyrole

        @hasanyrole('admin|manager|telecaller|guide')
        <li class="menu-item-has-children dropdown {{ request()->is('admin/arivals*') ? 'active show' : '' }}">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="menu-icon fa fa-plane"></i>
            {{ __('Arivals') }}
          </a>
          <ul class="sub-menu children dropdown-menu {{ request()->is('admin/arivals*') ? 'show' : '' }}">
            <li class="{{ request()->is('admin/arivals') ? 'active' : '' }}">
              <a href="{{ url('admin/arivals') }}">
                <i class="fa fa-file-text"></i>
                {{ __('List') }}
              </a>
            </li>
            @hasanyrole('admin|manager')
            <li class="{{ request()->is('admin/arivals/create') ? 'active' : '' }}">
              <a href="{{ url('admin/arivals/create') }}">
                <i class="fa fa-file"></i>
                {{ __('New') }}
              </a>
            </li>
            @endhasanyrole
          </ul>
        </li>
        @endhasanyrole

        @hasanyrole('admin|manager|telecaller')
        <li class="menu-title">{{ __('Bookings') }}</li>
        @endhasanyrole

        @hasanyrole('admin|manager|telecaller')
        <li class="{{ request()->is('admin/bookings/tour-packages*') ? 'active' : '' }}">
          <a href="{{ url('admin/bookings/tour-packages') }}">
            <i class="menu-icon fa fa-plane"></i>
            {{ __('Tour Packages') }}
          </a>
        </li>
        @endhasanyrole


        @hasanyrole('admin|manager|telecaller')
        <li class="{{ request()->is('admin/bookings/hotels*') ? 'active' : '' }}">
          <a href="{{ url('admin/bookings/hotels') }}">
            <i class="menu-icon fa fa-building"></i>
            {{ __('Hotels') }}
          </a>
        </li>
        @endhasanyrole

        @hasanyrole('admin|manager|telecaller')
        <li class="{{ request()->is('admin/bookings/activities*') ? 'active' : '' }}">
          <a href="{{ url('admin/bookings/activities') }}">
            <i class="menu-icon fa fa-wheelchair-alt"></i>
            {{ __('Activities') }}
          </a>
        </li>
        @endhasanyrole


        @hasanyrole('admin|manager|telecaller')
        <li class="{{ request()->is('admin/bookings/cruises-bookings*') ? 'active' : '' }}">
          <a href="{{ url('admin/bookings/cruises-bookings') }}">
            <i class="menu-icon fa fa-ship"></i>
            {{ __('Ferry Bookings') }}
          </a>
        </li>
        @endhasanyrole

        @hasanyrole('admin|manager|telecaller')
        <li class="{{ request()->is('admin/bookings/cabs*') ? 'active' : '' }}">
          <a href="{{ url('admin/bookings/cabs') }}">
            <i class="menu-icon fa fa-car"></i>
            {{ __('Cabs') }}
          </a>
        </li>
        @endhasanyrole

        @hasanyrole('admin|manager|telecaller')
        <li class="{{ request()->is('admin/bookings/bikes*') ? 'active' : '' }}">
          <a href="{{ url('admin/bookings/bikes') }}">
            <i class="menu-icon fa fa-motorcycle"></i>
            {{ __('Bikes') }}
          </a>
        </li>
        @endhasanyrole


        @hasanyrole('admin|manager|telecaller')
        <li class="{{ request()->is('admin/bookings/boat-trips*') ? 'active' : '' }}">
          <a href="{{ url('admin/bookings/boat-trips') }}">
            <i class="menu-icon fa fa-ship"></i>
            {{ __('Boat Trips') }}
          </a>
        </li>
        @endhasanyrole

        @hasanyrole('admin|manager')
        <li class="menu-title">{{ __('Office') }}</li>
        @endhasanyrole

        @hasanyrole('admin|manager')
        <li class="menu-item-has-children dropdown {{ request()->is('admin/employees*') ? 'active show' : '' }}">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="menu-icon fa fa-id-badge"></i>
            {{ __('Employees') }}
          </a>
          <ul class="sub-menu children dropdown-menu {{ request()->is('admin/employees*') ? 'show' : '' }}">
            <li class="{{ request()->is('admin/employees') ? 'active' : '' }}">
              <a href="{{ url('admin/employees') }}">
                <i class="fa fa-file-text"></i>
                {{ __('List') }}
              </a>
            </li>
            <li class="{{ request()->is('admin/employees/create') ? 'active' : '' }}">
              <a href="{{ url('admin/employees/create') }}">
                <i class="fa fa-file"></i>
                {{ __('New') }}
              </a>
            </li>
          </ul>
        </li>
        @endhasanyrole

        @hasanyrole('admin|manager')
        <li class="menu-item-has-children dropdown {{ request()->is('admin/teams*') ? 'active show' : '' }}">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <i class="menu-icon fa fa-users"></i>
            {{ __('Team')}}
          </a>

          <ul class="sub-menu children dropdown-menu {{ request()->is('admin/teams*') ? 'show' : '' }} ">
            <li class="{{ request()->is('admin/teams') ? 'active' : '' }}">
              <a href="{{ url('admin/teams') }}">
                <i class="fa fa-file-text"></i>
                {{ __('List') }}
              </a>
            </li>
            <li class="{{ request()->is('admin/teams/create') ? 'active' : '' }}">
              <a href="{{ url('admin/teams/create') }}">
                <i class="fa fa-file"></i>
                {{ __('New') }}
              </a>
            </li>
          </ul>
        </li>
        @endhasanyrole

        @hasanyrole('admin|manager')
        <li class="menu-item-has-children dropdown {{ request()->is('admin/cars*') ? 'active show' : '' }}">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="menu-icon fa fa-bus"></i>
            {{ __('Cars') }}
          </a>
          <ul class="sub-menu children dropdown-menu {{ request()->is('admin/cars*') ? 'show' : '' }}">
            <li class="{{ request()->is('admin/cars') ? 'active' : '' }}">
              <a href="{{ url('admin/cars') }}">
                <i class="fa fa-file-text"></i>
                {{ __('List') }}
              </a>
            </li>
            <li class="{{ request()->is('admin/cars/create') ? 'active' : '' }}">
              <a href="{{ url('admin/cars/create') }}">
                <i class="fa fa-file"></i>
                {{ __('New') }}
              </a>
            </li>
          </ul>
        </li>
        @endhasanyrole

        @hasanyrole('admin|manager')
        <li class="menu-title">{{ __('Manage') }}</li>
        @endhasanyrole
        @hasanyrole('admin|manager|telecaller|guide|driver')
        <li class="menu-item-has-children dropdown {{ request()->is('admin/tag-manager*') ? 'active show' : '' }}">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="menu-icon fa fa-tag"></i>
            {{ __('Tag Manager') }}
          </a>
          <ul class="sub-menu children dropdown-menu {{ request()->is('admin/tag-manager*') ? 'show' : '' }}">
            <li class="{{ request()->is('admin/tag-manager') ? 'active' : '' }}">
              <a href="{{ url('admin/tag-manager') }}">
                <i class="fa fa-file"></i>
                {{ __('Tags') }}
              </a>
            </li>
            <li class="{{ request()->is('admin/tag-manager/pages') ? 'active' : '' }}">
              <a href="{{ route('admin.tag-manager.pages') }}">
                <i class="fa fa-file-text"></i>
                {{ __('Pages') }}
              </a>
            </li>

          </ul>
        </li>

        @endhasanyrole
        @hasanyrole('admin|manager')
        <li class="menu-item-has-children dropdown {{ request()->is('admin/tours*') ? 'active show' : '' }}">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="menu-icon fa fa-plane"></i>
            {{ __('Tours') }}
          </a>
          <ul class="sub-menu children dropdown-menu {{ request()->is('admin/tours*') ? 'show' : '' }}">
            <li class="{{ request()->is('admin/tours') ? 'active' : '' }}">
              <a href="{{ url('admin/tours') }}">
                <i class="fa fa-file-text"></i>
                {{ __('List') }}
              </a>
            </li>
            <li class="{{ request()->is('admin/tours/create') ? 'active' : '' }}">
              <a href="{{ url('admin/tours/create') }}">
                <i class="fa fa-file"></i>
                {{ __('New') }}
              </a>
            </li>
            <li class="{{ request()->is('admin/tours/package/services') ? 'active' : '' }}">
              <a href="{{ url('admin/tours/package/services') }}">
                <i class="fa fa-file"></i>
                {{ __('Tour Services') }}
              </a>
            </li>
            <li class="{{ request()->is('admin/tours/package/activity-services') ? 'active' : '' }}">
              <a href="{{ url('admin/tours/package/activity-services') }}">
                <i class="fa fa-file"></i>
                {{ __('Tour Activities') }}
              </a>
            </li>
            <li class="{{ request()->is('admin/tours/package/ferry-services') ? 'active' : '' }}">
              <a href="{{ url('admin/tours/package/ferry-services') }}">
                <i class="fa fa-file"></i>
                {{ __('Tour Ferries') }}
              </a>
            </li>
            <li class="{{ request()->is('admin/tours/package/payment-breakup') ? 'active' : '' }}">
              <a href="{{ url('admin/tours/package/payment-breakup') }}">
                <i class="fa fa-exchange"></i>
                {{ __('Payment Breakup') }}
              </a>
            </li>

          </ul>
        </li>
        @endhasanyrole

        @hasanyrole('admin|manager')
        <li class="menu-item-has-children dropdown {{ request()->is('admin/hotels*') ? 'active show' : '' }}">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="menu-icon fa fa-building"></i>
            {{ __('Hotels') }}
          </a>
          <ul class="sub-menu children dropdown-menu {{ request()->is('admin/hotels*') ? 'show' : '' }}">
            <li class="{{ request()->is('admin/hotels') ? 'active' : '' }}">
              <a href="{{ url('admin/hotels') }}">
                <i class="fa fa-file-text"></i>
                {{ __('List') }}
              </a>
            </li>
            <li class="{{ request()->is('admin/hotels/create') ? 'active' : '' }}">
              <a href="{{ url('admin/hotels/create') }}">
                <i class="fa fa-file"></i>
                {{ __('New') }}
              </a>
            </li>
          </ul>
        </li>
        @endhasanyrole

        @hasanyrole('admin|manager')
        <li class="menu-item-has-children dropdown {{ request()->is('admin/activities*') ? 'active show' : '' }}">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="menu-icon fa fa-wheelchair-alt"></i>
            {{ __('Activities') }}
          </a>
          <ul class="sub-menu children dropdown-menu {{ request()->is('admin/activities*') ? 'show' : '' }}">
            <li class="{{ request()->is('admin/activities') ? 'active' : '' }}">
              <a href="{{ url('admin/activities') }}">
                <i class="fa fa-file-text"></i>
                {{ __('List') }}
              </a>
            </li>
            <li class="{{ request()->is('admin/activities/create') ? 'active' : '' }}">
              <a href="{{ url('admin/activities/create') }}">
                <i class="fa fa-file"></i>
                {{ __('New') }}
              </a>
            </li>
          </ul>
        </li>
        @endhasanyrole

        @hasanyrole('admin|manager')
        <li class="menu-item-has-children dropdown {{ request()->is('admin/cruises*') ? 'active show' : '' }}">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="menu-icon fa fa-ship"></i>
            {{ __('Cruises') }}
          </a>
          <ul class="sub-menu children dropdown-menu {{ request()->is('admin/cruises*') ? 'show' : '' }}">
            <li class="{{ request()->is('admin/cruises') ? 'active' : '' }}">
              <a href="{{ url('admin/cruises') }}">
                <i class="fa fa-file-text"></i>
                {{ __('List') }}
              </a>
            </li>
            <li class="{{ request()->is('admin/cruises/create') ? 'active' : '' }}">
              <a href="{{ url('admin/cruises/create') }}">
                <i class="fa fa-file"></i>
                {{ __('New') }}
              </a>
            </li>
          </ul>
        </li>
        @endhasanyrole



        @hasanyrole('admin|manager')
        <li class="menu-item-has-children dropdown {{ request()->is('admin/boat-locations*', 'admin/boat-trips*') ? 'active show' : '' }}">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="menu-icon fa fa-ship"></i>
            {{ __('Boat Trips') }}
          </a>
          <ul class="sub-menu children dropdown-menu {{ request()->is('admin/boat-locations*') ? 'show' : '' }}">
            <li class="{{ request()->is('admin/boat-locations') ? 'active' : '' }}">
              <a href="{{ url('admin/boat-locations') }}">
                <i class="fa fa-file-text"></i>
                {{ __('List') }}
              </a>
            </li>
            <li class="{{ request()->is('admin/boat-trips/create') ? 'active' : '' }}">
              <a href="{{ url('admin/boat-trips/create') }}">
                <i class="fa fa-file"></i>
                {{ __('New') }}
              </a>
            </li>
          </ul>
        </li>
        @endhasanyrole

        @hasanyrole('admin|manager')
        <li class="menu-item-has-children dropdown {{ request()->is('admin/cabs*') ? 'active show' : '' }}">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="menu-icon fa fa-car"></i>
            {{ __('Cabs') }}
          </a>
          <ul class="sub-menu children dropdown-menu {{ request()->is('admin/cabs*') ? 'show' : '' }}">
            <li class="{{ request()->is('admin/cabs') ? 'active' : '' }}">
              <a href="{{ url('admin/cabs') }}">
                <i class="fa fa-file-text"></i>
                {{ __('List') }}
              </a>
            </li>
            <li class="{{ request()->is('admin/cabs/create') ? 'active' : '' }}">
              <a href="{{ url('admin/cabs/create') }}">
                <i class="fa fa-file"></i>
                {{ __('New') }}
              </a>
            </li>
            <!-- <li class="{{ request()->is('admin/cab/packages') ? 'active' : '' }}">
              <a href="{{ url('admin/cab/packages') }}">
                <i class="fa fa-file"></i>
                {{ __('Packages') }}
              </a>
            </li> -->
            <!-- <li class="{{ request()->is('admin/cab/packages/create') ? 'active' : '' }}">
              <a href="{{ url('admin/cab/packages/create') }}">
                <i class="fa fa-file"></i>
                {{ __('New Packages') }}
              </a>
            </li> -->
            <li class="{{ request()->is('admin/cab/packages/pricing') ? 'active' : '' }}">
              <a href="{{ url('admin/cab/packages/pricing') }}">
                <i class="fa fa-file"></i>
                {{ __('Trip Pricing') }}
              </a>
            </li>
          </ul>
        </li>
        @endhasanyrole

        @hasanyrole('admin|manager')
        <li class="menu-item-has-children dropdown {{ request()->is('admin/bikes*') ? 'active show' : '' }}">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="menu-icon fa fa-motorcycle"></i>
            {{ __('Bikes') }}
          </a>
          <ul class="sub-menu children dropdown-menu {{ request()->is('admin/bikes*') ? 'show' : '' }}">
            <li class="{{ request()->is('admin/bikes') ? 'active' : '' }}">
              <a href="{{ url('admin/bikes') }}">
                <i class="fa fa-file-text"></i>
                {{ __('List') }}
              </a>
            </li>
            <li class="{{ request()->is('admin/bikes/create') ? 'active' : '' }}">
              <a href="{{ url('admin/bikes/create') }}">
                <i class="fa fa-file"></i>
                {{ __('New') }}
              </a>
            </li>
          </ul>
        </li>
        @endhasanyrole

        {{-- boat charter menu --}}
        @hasanyrole('admin|manager')
        <li class="menu-item-has-children dropdown {{ request()->is('admin/boat-charter*') ? 'active show' : '' }}">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="menu-icon fa fa-ship"></i>
            {{ __('Boat Charter') }}
          </a>
          <ul class="sub-menu children dropdown-menu {{ request()->is('admin/boat-charter*') ? 'show' : '' }}">
            <li class="{{ request()->is('admin/boat-charter') ? 'active' : '' }}">
              <a href="{{ url('admin/boat-charter') }}">
                <i class="fa fa-file-text"></i>
                {{ __('List') }}
              </a>
            </li>
            <li class="{{ request()->is('admin/boat-charter/create') ? 'active' : '' }}">
              <a href="{{ url('admin/boat-charter/create') }}">
                <i class="fa fa-file"></i>
                {{ __('New') }}
              </a>
            </li>
          </ul>
        </li>
        @endhasanyrole
        {{-- Boat Charter menu ends here --}}

        @hasanyrole('admin|manager')
        <li class="menu-item-has-children dropdown {{ request()->is('admin/addons*') ? 'active show' : '' }}">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="menu-icon fa fa-list-alt"></i>
            {{ __('Addons') }}
          </a>
          <ul class="sub-menu children dropdown-menu {{ request()->is('admin/addons*') ? 'show' : '' }}">
            <li class="{{ request()->is('admin/addons') ? 'active' : '' }}">
              <a href="{{ url('admin/addons') }}">
                <i class="fa fa-file-text"></i>
                {{ __('List') }}
              </a>
            </li>
            <li class="{{ request()->is('admin/addons/create') ? 'active' : '' }}">
              <a href="{{ url('admin/addons/create') }}">
                <i class="fa fa-file"></i>
                {{ __('New') }}
              </a>
            </li>
          </ul>
        </li>
        @endhasanyrole

        @hasanyrole('admin|manager')
        <li class="menu-item-has-children dropdown {{ request()->is('admin/categories*') ? 'active show' : '' }}">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="menu-icon fa fa-th-list"></i>
            {{ __('Categories') }}
          </a>
          <ul class="sub-menu children dropdown-menu {{ request()->is('admin/categories*') ? 'show' : '' }}">
            <li class="{{ request()->is('admin/categories') ? 'active' : '' }}">
              <a href="{{ url('admin/categories') }}">
                <i class="fa fa-file-text"></i>
                {{ __('List') }}
              </a>
            </li>
            <li class="{{ request()->is('admin/categories/create') ? 'active' : '' }}">
              <a href="{{ url('admin/categories/create') }}">
                <i class="fa fa-file"></i>
                {{ __('New') }}
              </a>
            </li>
          </ul>
        </li>
        @endhasanyrole

        @hasanyrole('admin|manager')
        <li class="menu-item-has-children dropdown {{ request()->is('admin/blogs*') ? 'active show' : '' }}">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="menu-icon fa fa-th-list"></i>
            {{ __('Blogs') }}
          </a>
          <ul class="sub-menu children dropdown-menu {{ request()->is('admin/blogs*') ? 'show' : '' }}">
            <li class="{{ request()->is('admin/blogs') ? 'active' : '' }}">
              <a href="{{ url('admin/blogs') }}">
                <i class="fa fa-file-text"></i>
                {{ __('List') }}
              </a>
            </li>
            <li class="{{ request()->is('admin/blogs/create') ? 'active' : '' }}">
              <a href="{{ url('admin/blogs/create') }}">
                <i class="fa fa-file"></i>
                {{ __('New') }}
              </a>
            </li>
          </ul>
        </li>
        @endhasanyrole

        @hasanyrole('admin|manager')
        <li class="menu-item-has-children dropdown {{ request()->is('admin/reviews*') ? 'active show' : '' }}">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="menu-icon fa fa-th-list"></i>
            {{ __('Reviews') }}
          </a>
          <ul class="sub-menu children dropdown-menu {{ request()->is('admin/reviews*') ? 'show' : '' }}">
            <li class="{{ request()->is('admin/reviews') ? 'active' : '' }}">
              <a href="{{ url('admin/reviews') }}">
                <i class="fa fa-file-text"></i>
                {{ __('List') }}
              </a>
            </li>
            <li class="{{ request()->is('admin/reviews/create') ? 'active' : '' }}">
              <a href="{{ url('admin/reviews/create') }}">
                <i class="fa fa-file"></i>
                {{ __('New') }}
              </a>
            </li>
          </ul>
        </li>
        @endhasanyrole



        @hasanyrole('admin|manager')
        <li class="menu-title">{{ __('Users') }}</li>
        @endhasanyrole
        @hasanyrole('admin|manager')
        <li class="menu-item-has-children dropdown {{ request()->is('admin/users*') ? 'active show' : '' }}">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="menu-icon fa fa-user"></i>
            {{ __('Users') }}
          </a>
          <ul class="sub-menu children dropdown-menu {{ request()->is('admin/users*') ? 'show' : '' }}">
            <li class="{{ request()->is('admin/users') ? 'active' : '' }}">
              <a href="{{ url('admin/users') }}">
                <i class="fa fa-file-text"></i>
                {{ __('List') }}
              </a>
            </li>
          </ul>
        </li>
        @endhasanyrole
        @hasanyrole('admin|manager|telecaller|guide|driver')
        <li class="{{ request()->is('admin/visitors*') ? 'active' : '' }}">
          <a href="{{ url('admin/visitors') }}">
            <i class="menu-icon fa fa-laptop"></i>
            {{ __('Visitors') }}
          </a>
        </li>
        @endhasanyrole
      </ul>
    </div><!-- /.navbar-collapse -->
  </nav>
</aside>
<!-- /#left-panel -->