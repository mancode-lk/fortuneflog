(function () {
    'use strict';
    if (localStorage.getItem("zanexdarktheme")) {
        document.querySelector("html").setAttribute("data-theme-mode", "dark")
        document.querySelector("html").setAttribute("data-menu-styles", "dark")
        document.querySelector("html").setAttribute("data-header-styles", "dark")
    }
    if (localStorage.zanexrtl) {
        let html = document.querySelector('html');
        html.setAttribute("dir", "rtl");
        document.querySelector("#style")?.setAttribute("href", "../assets/libs/bootstrap/css/bootstrap.rtl.min.css");
    }
    if (localStorage.zanexlayout) {
        let html = document.querySelector('html');
        html.setAttribute("data-nav-layout", "horizontal");
        document.querySelector("html").setAttribute("data-menu-styles", "light")
    }
    if (localStorage.getItem("zanexlayout") == "horizontal") {
        document.querySelector("html").setAttribute("data-nav-layout", "horizontal")
    }
    if(localStorage.loaderEnable == 'true'){
        document.querySelector("html").setAttribute("loader","enable");
    }else{
        if(!document.querySelector("html").getAttribute("loader")){
            document.querySelector("html").setAttribute("loader","disable");
        }
    }

    function localStorageBackup() {

        // if there is a value stored, update color picker and background color
        // Used to retrive the data from local storage
        if (localStorage.primaryRGB) {
            if (document.querySelector('.theme-container-primary')) {
                document.querySelector('.theme-container-primary').value = localStorage.primaryRGB;
            }
            document.querySelector('html').style.setProperty('--primary-rgb', localStorage.primaryRGB);
        }
        if (localStorage.bodyBgRGB && localStorage.bodylightRGB) {
            if (document.querySelector('.theme-container-background')) {
                document.querySelector('.theme-container-background').value = localStorage.bodyBgRGB;
            }
            document.querySelector('html').style.setProperty('--body-bg-rgb', localStorage.bodyBgRGB);
            document.querySelector('html').style.setProperty('--body-bg-rgb2', localStorage.bodylightRGB);
            document.querySelector('html').style.setProperty('--light-rgb', localStorage.bodylightRGB);
            document.querySelector('html').style.setProperty('--form-control-bg', `rgb(${localStorage.bodylightRGB})`);
            document.querySelector('html').style.setProperty('--input-border', "rgba(255,255,255,0.1)");
            let html = document.querySelector('html');
            html.setAttribute('data-theme-mode', 'dark');
            html.setAttribute('data-menu-styles', 'dark');
            html.setAttribute('data-header-styles', 'dark');
        }
        if (localStorage.zanexdarktheme) {
            let html = document.querySelector('html');
            html.setAttribute('data-theme-mode', 'dark');
        }
        if (localStorage.zanexlayout) {
            let html = document.querySelector('html');
            let layoutValue = localStorage.getItem('zanexlayout');
            html.setAttribute('data-nav-layout', 'horizontal');
            setTimeout(() => {
                clearNavDropdown();
            }, 5000);
            html.setAttribute('data-nav-style', 'menu-click');
            setTimeout(() => {
                checkHoriMenu();
            }, 5000);
        }
        if (localStorage.zanexverticalstyles) {
            let html = document.querySelector('html');
            let verticalStyles = localStorage.getItem('zanexverticalstyles');

            if (verticalStyles == 'default') {
                html.setAttribute('data-vertical-style', 'default');
                localStorage.removeItem("zanexnavstyles")
            }
            if (verticalStyles == 'closed') {
                html.setAttribute('data-vertical-style', 'closed');
                localStorage.removeItem("zanexnavstyles")
            }
            if (verticalStyles == 'icontext') {
                html.setAttribute('data-vertical-style', 'icontext');
                localStorage.removeItem("zanexnavstyles")
            }
            if (verticalStyles == 'overlay') {
                html.setAttribute('data-vertical-style', 'overlay');
                localStorage.removeItem("zanexnavstyles")
            }
            if (verticalStyles == 'detached') {
                html.setAttribute('data-vertical-style', 'detached');
                localStorage.removeItem("zanexnavstyles")
            }
            if (verticalStyles == 'doublemenu') {
                html.setAttribute('data-vertical-style', 'doublemenu');
                localStorage.removeItem("ynexnavstyles");
                setTimeout(() => {
                    const menuSlideItem = document.querySelectorAll(".main-menu > li > .side-menu__item");
            
                    // Create the tooltip element
                    const tooltip = document.createElement("div");
                    tooltip.className = "custom-tooltip";
                    tooltip.style.position = "fixed";
                    tooltip.style.display = "none";
                    tooltip.style.padding = "0.5rem";
                    tooltip.style.fontWeight = "500";
                    tooltip.style.fontSize = "0.75rem";
                    tooltip.style.backgroundColor = "rgb(15, 23, 42)";
                    tooltip.style.color = "rgb(255, 255, 255)";
                    tooltip.style.marginInlineStart = "45px";
                    tooltip.style.borderRadius = "0.25rem";
                    tooltip.style.zIndex = "99";
            
                    menuSlideItem.forEach((e) => {
                        // Add an event listener to show the tooltip on mouseenter
                        e.addEventListener("mouseenter", () => {
                            tooltip.style.display = "block";
                            tooltip.textContent = e.querySelector(".side-menu__label").textContent;
                            if (document.querySelector("html").getAttribute("data-vertical-style") == "doublemenu") {
                                e.appendChild(tooltip);
                            }
                        });
            
                        // Add an event listener to hide the tooltip on mouseleave
                        e.addEventListener("mouseleave", () => {
                            tooltip.style.display = "none";
                            tooltip.textContent = e.querySelector(".side-menu__label").textContent;
                            e.removeChild(tooltip); // Remove the tooltip element from the DOM
                        });
                    });
                }, 1000);
            }
            
        }
        if (localStorage.zanexnavstyles) {
            let html = document.querySelector('html');
            let navStyles = localStorage.getItem('zanexnavstyles');
            if (navStyles == 'menu-click') {
                html.setAttribute('data-nav-style', 'menu-click');
                localStorage.removeItem("zanexverticalstyles");
                html.removeAttribute('data-vertical-style');
            }
            if (navStyles == 'menu-hover') {
                html.setAttribute('data-nav-style', 'menu-hover');
                localStorage.removeItem("zanexverticalstyles");
                html.removeAttribute('data-vertical-style');
            }
            if (navStyles == 'icon-click') {
                html.setAttribute('data-nav-style', 'icon-click');
                localStorage.removeItem("zanexverticalstyles");
                html.removeAttribute('data-vertical-style');
            }
            if (navStyles == 'icon-hover') {
                html.setAttribute('data-nav-style', 'icon-hover');
                localStorage.removeItem("zanexverticalstyles");
                html.removeAttribute('data-vertical-style');
            }
        }
        if (localStorage.zanexclassic) {
            let html = document.querySelector('html');
            html.setAttribute('data-page-style', 'classic'); 
        }
        if (localStorage.zanexmodern) {
            let html = document.querySelector('html');
            html.setAttribute('data-page-style', 'modern');
        }
        if (localStorage.zanexboxed) {
            let html = document.querySelector('html');
            html.setAttribute('data-width', 'boxed');
        }
        if (localStorage.zanexheaderfixed) {
            let html = document.querySelector('html');
            html.setAttribute('data-header-position', 'fixed');
        }
        if (localStorage.zanexheaderscrollable) {
            let html = document.querySelector('html');
            html.setAttribute('data-header-position', 'scrollable');
        }
        if (localStorage.zanexmenufixed) {
            let html = document.querySelector('html');
            html.setAttribute('data-menu-position', 'fixed');
        }
        if (localStorage.zanexmenuscrollable) {
            let html = document.querySelector('html');
            html.setAttribute('data-menu-position', 'scrollable');
        }
        if (localStorage.zanexMenu) {
            let html = document.querySelector('html');
            let menuValue = localStorage.getItem('zanexMenu');
            switch (menuValue) {
                case 'light':
                    html.setAttribute('data-menu-styles', 'light');
                    break;
                case 'dark':
                    html.setAttribute('data-menu-styles', 'dark');
                    break;
                case 'color':
                    html.setAttribute('data-menu-styles', 'color');
                    break;
                case 'gradient':
                    html.setAttribute('data-menu-styles', 'gradient');
                    break;
                case 'transparent':
                    html.setAttribute('data-menu-styles', 'transparent');
                    break;
                default:
                    break;
            }
        }
        if (localStorage.zanexHeader) {
            let html = document.querySelector('html');
            let headerValue = localStorage.getItem('zanexHeader');
            switch (headerValue) {
                case 'light':
                    html.setAttribute('data-header-styles', 'light');
                    break;
                case 'dark':
                    html.setAttribute('data-header-styles', 'dark');
                    break;
                case 'color':
                    html.setAttribute('data-header-styles', 'color');
                    break;
                case 'gradient':
                    html.setAttribute('data-header-styles', 'gradient');
                    break;
                case 'transparent':
                    html.setAttribute('data-header-styles', 'transparent');
                    break;

                default:
                    break;
            }
        }
        if (localStorage.bgimg) {
            let html = document.querySelector('html');
            let value = localStorage.getItem('bgimg');
            html.setAttribute('data-bg-img', value);
        }
    }
    localStorageBackup()        

})();