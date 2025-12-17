document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu functionality
    const mobileMenuToggle = document.getElementById('navbarTogglerButton');
    const mobileMenuClose = document.getElementById('mobile-menu-close');
    const mobileMenu = document.getElementById('mobile-sidebar-menu');
    const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');

    // Toggle mobile menu
    if (mobileMenuToggle) {
        mobileMenuToggle.addEventListener('click', function(e) {
            e.preventDefault();
            mobileMenu.classList.add('active');
            mobileMenuOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        });
    }

    // Close mobile menu
    if (mobileMenuClose) {
        mobileMenuClose.addEventListener('click', function(e) {
            e.preventDefault();
            closeMenu();
        });
    }

    // Close menu when clicking overlay
    if (mobileMenuOverlay) {
        mobileMenuOverlay.addEventListener('click', function() {
            closeMenu();
        });
    }

    // Function to close the menu
    function closeMenu() {
        mobileMenu.classList.remove('active');
        mobileMenuOverlay.classList.remove('active');
        document.body.style.overflow = '';

        // Close all open submenus when closing the menu
        const openSubmenus = document.querySelectorAll('.mobile-submenu.active');
        const activeToggles = document.querySelectorAll('.mobile-submenu-toggle.active');

        openSubmenus.forEach(function(submenu) {
            submenu.classList.remove('active');
            submenu.style.maxHeight = null;
        });

        activeToggles.forEach(function(toggle) {
            toggle.classList.remove('active');
        });
    }

    // Initialize submenu toggles
    function initSubmenuToggles() {
        const submenuToggles = document.querySelectorAll('.mobile-submenu-toggle');

        // Remove all existing event listeners
        submenuToggles.forEach(function(toggle) {
            const newToggle = toggle.cloneNode(true);
            if (toggle.parentNode) {
                toggle.parentNode.replaceChild(newToggle, toggle);
            }
        });

        // Add new event listeners
        document.querySelectorAll('.mobile-submenu-toggle').forEach(function(toggle) {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                // Find the parent item and submenu
                let parent, submenu;

                // Handle different levels of nesting
                if (this.classList.contains('level-3')) {
                    // For level 3 toggles
                    parent = this.closest('.mobile-submenu-item.has-submenu');
                    submenu = parent.querySelector('.mobile-submenu.level-3');
                } else if (this.classList.contains('level-2')) {
                    // For level 2 toggles
                    parent = this.closest('.mobile-submenu-item.has-submenu');
                    submenu = parent.querySelector('.mobile-submenu.level-2');
                } else {
                    // For level 1 toggles
                    parent = this.closest('.mobile-menu-item');
                    submenu = parent.querySelector('.mobile-submenu');
                }

                if (!submenu) return;

                // Close all other open submenus at the same level
                const siblings = parent.parentNode.querySelectorAll(parent.classList.contains('mobile-submenu-item') ? '.mobile-submenu-item' : '.mobile-menu-item');
                siblings.forEach(function(sibling) {
                    if (sibling !== parent) {
                        const siblingSubmenu = sibling.querySelector(parent.classList.contains('mobile-submenu-item') ? '.mobile-submenu.level-2' : '.mobile-submenu');
                        const siblingToggle = sibling.querySelector('.mobile-submenu-toggle');
                        if (siblingSubmenu && siblingSubmenu.classList.contains('active')) {
                            siblingSubmenu.classList.remove('active');
                            siblingSubmenu.style.maxHeight = null;
                            if (siblingToggle) siblingToggle.classList.remove('active');
                        }
                    }
                });

                // Toggle current submenu
                this.classList.toggle('active');
                submenu.classList.toggle('active');

                if (submenu.classList.contains('active')) {
                    // For level-3 submenus, we use a fixed height with scrolling
                    if (submenu.classList.contains('level-3')) {
                        submenu.style.maxHeight = '200px';
                    }
                    // For level-2 submenus, we use a fixed height with scrolling
                    else if (submenu.classList.contains('level-2')) {
                        submenu.style.maxHeight = '300px';
                    } else {
                        // Calculate the proper height for level-1 submenus
                        let totalHeight = submenu.scrollHeight;

                        // If this submenu contains active nested submenus, add their heights
                        // but cap at a reasonable maximum to prevent overflow
                        const nestedActiveSubmenus = submenu.querySelectorAll('.mobile-submenu.active');
                        nestedActiveSubmenus.forEach(function(nestedSubmenu) {
                            if (nestedSubmenu.classList.contains('level-3')) {
                                totalHeight += 200; // Fixed height for level-3 submenus
                            } else if (nestedSubmenu.classList.contains('level-2')) {
                                totalHeight += 300; // Fixed height for level-2 submenus
                            } else {
                                totalHeight += nestedSubmenu.scrollHeight;
                            }
                        });

                        // Set a maximum height for very long submenus
                        const maxHeight = window.innerHeight * 0.7; // 70% of viewport height
                        submenu.style.maxHeight = Math.min(totalHeight, maxHeight) + "px";

                        // If this is a nested submenu, update parent submenu height
                        let parentSubmenu = submenu.closest('.mobile-submenu.active');
                        if (parentSubmenu) {
                            let parentTotalHeight = parentSubmenu.scrollHeight;
                            const parentNestedSubmenus = parentSubmenu.querySelectorAll('.mobile-submenu.active');
                            parentNestedSubmenus.forEach(function(nestedSubmenu) {
                                if (nestedSubmenu !== submenu) {
                                    parentTotalHeight += nestedSubmenu.scrollHeight;
                                }
                            });
                            parentSubmenu.style.maxHeight = Math.min(parentTotalHeight + totalHeight, maxHeight) + "px";
                        }
                    }
                } else {
                    submenu.style.maxHeight = null;

                    // Close all child submenus
                    const childSubmenus = submenu.querySelectorAll('.mobile-submenu.active');
                    const childToggles = submenu.querySelectorAll('.mobile-submenu-toggle.active');

                    childSubmenus.forEach(function(childSubmenu) {
                        childSubmenu.classList.remove('active');
                        childSubmenu.style.maxHeight = null;
                    });

                    childToggles.forEach(function(childToggle) {
                        childToggle.classList.remove('active');
                    });
                }
            });
        });

        // Prevent menu links from closing the menu when clicking on them
        // document.querySelectorAll('.mobile-menu-link').forEach(function(link) {
        //     link.addEventListener('click', function(e) {
        //         if (this.nextElementSibling && this.nextElementSibling.classList.contains('mobile-submenu')) {
        //             e.preventDefault();
        //         }
        //     });
        // });
    }

    // Initialize on page load
    initSubmenuToggles();

    // Re-initialize when window is resized
    window.addEventListener('resize', function() {
        // Only re-initialize if the mobile menu is visible
        if (window.innerWidth <= 991) {
            initSubmenuToggles();
        }
    });

    // Handle escape key to close menu
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && mobileMenu.classList.contains('active')) {
            closeMenu();
        }
    });
});
