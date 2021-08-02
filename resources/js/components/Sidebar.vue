<template>
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                 <div class="sb-sidenav-menu-heading">Core</div>
                <router-link to="/" class="nav-link">
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-tachometer-alt"></i>
                    </div>
                    <span> Dashboard </span>
                </router-link>
               
                <div class="sb-sidenav-menu-heading">Addons</div>
                <router-link to="/categories" class="nav-link" exact>
                 <div class="sb-nav-link-icon">
                        <i class="fas fa-chart-area"></i>
                    </div>
                    <span>Categories</span>
                </router-link>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            Start Bootstrap
        </div>
    </nav>
</template>
