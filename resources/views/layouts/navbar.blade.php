<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{route('dashboard')}}">
            <img style="width: 50px" src="{{asset('images/logo.jpg')}}">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
           <div class="d-flex" style="margin-left: auto;padding-right: 20px;">
               <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                   <li class="nav-item">
                       <a class="nav-link active" aria-current="page" href="{{ route('dashboard') }}">Productos</a>
                   </li>
                   <li class="nav-item">
                       <a class="nav-link active" aria-current="page" href="{{route('show.menus')}}">Menus</a>
                   </li>
                   @auth
                       <li class="nav-item dropdown">
                           <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                               {{ \Illuminate\Support\Facades\Auth::user()->name }}
                           </a>
                           <ul class="dropdown-menu">
                               <li><a class="dropdown-item" href="{{route('show.profile')}}">Mi perfil</a></li>
                               <li><a class="dropdown-item" href="#">Mis pedidos</a></li>
                               @if(\Illuminate\Support\Facades\Auth::user()->rol_id == 2)
                                   <li><a class="dropdown-item" href="{{route('show.extras.admin')}}">Editar Extras</a></li>
                                   <li><a class="dropdown-item" href="{{route('show.products.admin')}}">Editar Productos</a></li>
                                   <li><a class="dropdown-item" href="{{route('show.menus.admin')}}">Editar Menús</a></li>
                                   <li><a class="dropdown-item" href="{{route('show.users.admin')}}">Editar Usuarios</a></li>
                                   <li><a class="dropdown-item" href="#">Editar Pedidos</a></li>
                               @endif
                               <li><hr class="dropdown-divider"></li>
                               <li><a class="dropdown-item" href="#" onclick="
                        event.preventDefault();
                        document.getElementById('logout-form').submit();
                        " >Cerrar sesion</a></li>
                               <form id="logout-form" action="{{route('logout')}}" method="post">
                                   @csrf
                               </form>
                           </ul>
                       </li>
                   @endauth

                   @guest
                       <li class="nav-item">
                           <a class="nav-link" href="{{route('login')}}">Acceder</a>
                       </li>
                   @endguest
               </ul>
           </div>

        </div>
    </div>
</nav>
