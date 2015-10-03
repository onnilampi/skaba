    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span> 
                </button>
                <span class="navbar-brand">Admin-toiminnot</span>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li class="dropdown fat-dropdown">
                        <a href="#" class="dropdown-toggle" role="button" id="users" data-toggle="dropdown" aria-haspopup="true" aria-expanded ="true">
                            Käyttäjät
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="users">
                            <li><a href="/Users/add"><?= __('Uusi käyttäjä'); ?></a></li>
                            <li><a href="/Users/"><?= __('Näytä käyttäjät'); ?></a></li>
                        </ul>
                    </li>                    
                <!--</ul>
                <ul class="nav navbar-nav">-->
                    <li class="dropdown fat-dropdown">
                        <a href="#" class="dropdown-toggle" role="button" id="events" data-toggle="dropdown" aria-haspopup="true" aria-expanded ="true">
                            Tapahtumat
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="events">
                            <li><a href="/Events/add"><?= __('Uusi tapahtuma'); ?></a></li>
                            <li><a href="/Events/"><?= __('Näytä tapahtumat'); ?></a></li>
                        </ul>
                    </li>                    
                <!-- </ul> -->
                    <li><a href="/Attendances/"><?= __('Osallistumiset'); ?></a></li>
            </div>
        </div>
    </nav>    
</div>