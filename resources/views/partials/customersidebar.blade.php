<div class="app-sidebar__overlay" data-toggle="sidebar"></div>

<aside class="app-sidebar">
    
 <div class="app-sidebar__user"><img width="40 px" class="app-sidebar__user-avatar" src="{{ asset('images/user/'.Auth::user()->image) }}" alt="User Image"> 

        <div>
             <p class="app-sidebar__user-name">{{ Auth::user()->fullname }}</p> 
            <p class="app-sidebar__user-designation">Customer</p>
        </div>
     </div> 
     <ul class="app-menu">        
        <li class="treeview "><a class="app-menu__item" href="#"><i class="app-menu__icon fa fa-indent"></i><span class="app-menu__label">Query</span><i></i></a>
        </li>
    </ul>
  
</aside>