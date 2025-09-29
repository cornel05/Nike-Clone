// Nike Clone JavaScript

document.addEventListener('DOMContentLoaded', function() {
    initializeCountdowns();
    initializeSearch();
    initializeImageGalleries();
});

// Countdown Timer Functionality
function initializeCountdowns() {
    const countdowns = document.querySelectorAll('.countdown');
    
    countdowns.forEach(countdown => {
        const launchDate = countdown.getAttribute('data-launch-date');
        if (launchDate) {
            updateCountdown(countdown, new Date(launchDate));
            
            // Update every second
            setInterval(() => {
                updateCountdown(countdown, new Date(launchDate));
            }, 1000);
        }
    });
}

function updateCountdown(element, targetDate) {
    const now = new Date().getTime();
    const target = targetDate.getTime();
    const distance = target - now;
    
    if (distance > 0) {
        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
        const daysEl = element.querySelector('.days');
        const hoursEl = element.querySelector('.hours');
        const minutesEl = element.querySelector('.minutes');
        const secondsEl = element.querySelector('.seconds');
        
        if (daysEl) daysEl.textContent = String(days).padStart(2, '0');
        if (hoursEl) hoursEl.textContent = String(hours).padStart(2, '0');
        if (minutesEl) minutesEl.textContent = String(minutes).padStart(2, '0');
        if (secondsEl) secondsEl.textContent = String(seconds).padStart(2, '0');
    } else {
        // Launch has passed
        element.innerHTML = '<span class="text-danger">LAUNCHED</span>';
    }
}

// AJAX Search Functionality
function initializeSearch() {
    const searchInput = document.getElementById('searchInput');
    const searchResults = document.getElementById('searchResults');
    const searchForm = document.getElementById('searchForm');
    
    if (!searchInput || !searchResults) return;
    
    let searchTimeout;
    
    searchInput.addEventListener('input', function() {
        const query = this.value.trim();
        
        clearTimeout(searchTimeout);
        
        if (query.length < 2) {
            hideSearchResults();
            return;
        }
        
        searchTimeout = setTimeout(() => {
            performSearch(query);
        }, 300);
    });
    
    // Hide search results when clicking outside
    document.addEventListener('click', function(e) {
        if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
            hideSearchResults();
        }
    });
    
    // Handle form submission
    if (searchForm) {
        searchForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const query = searchInput.value.trim();
            if (query) {
                window.location.href = `/products/search?q=${encodeURIComponent(query)}`;
            }
        });
    }
}

function performSearch(query) {
    const searchResults = document.getElementById('searchResults');
    
    // Show loading state
    searchResults.innerHTML = '<div class="search-item text-center"><small class="text-muted">Searching...</small></div>';
    searchResults.style.display = 'block';
    
    fetch(`/api/products/search?q=${encodeURIComponent(query)}&limit=5`)
        .then(response => response.json())
        .then(data => {
            displaySearchResults(data.products || []);
        })
        .catch(error => {
            console.error('Search error:', error);
            searchResults.innerHTML = '<div class="search-item text-center"><small class="text-danger">Search failed</small></div>';
        });
}

function displaySearchResults(products) {
    const searchResults = document.getElementById('searchResults');
    const searchInput = document.getElementById('searchInput');
    
    if (products.length === 0) {
        searchResults.innerHTML = '<div class="search-item text-center"><small class="text-muted">No products found</small></div>';
        return;
    }
    
    let html = '';
    products.forEach(product => {
        html += `
            <div class="search-item" onclick="window.location.href='/product/${product.id}'">
                <div class="d-flex align-items-center">
                    <img src="${escapeHtml(product.image_url)}" alt="${escapeHtml(product.name)}" 
                         class="me-3 rounded" style="width: 40px; height: 40px; object-fit: cover;">
                    <div class="flex-grow-1">
                        <div class="fw-bold">${escapeHtml(product.name)}</div>
                        <small class="text-muted">${escapeHtml(product.category_name)} - $${parseFloat(product.price).toFixed(2)}</small>
                    </div>
                </div>
            </div>
        `;
    });
    
    // Add "View all results" link
    const query = searchInput.value.trim();
    html += `
        <div class="search-item text-center border-top">
            <a href="/products/search?q=${encodeURIComponent(query)}" class="text-decoration-none">
                <small>View all results for "${escapeHtml(query)}"</small>
            </a>
        </div>
    `;
    
    searchResults.innerHTML = html;
}

function hideSearchResults() {
    const searchResults = document.getElementById('searchResults');
    if (searchResults) {
        searchResults.style.display = 'none';
    }
}

// Image Gallery Functionality
function initializeImageGalleries() {
    // Product image galleries
    initializeProductGallery();
    // Launch image galleries  
    initializeLaunchGallery();
}

function initializeProductGallery() {
    const mainImage = document.getElementById('mainProductImage');
    const thumbs = document.querySelectorAll('.product-thumb');
    
    if (!mainImage || thumbs.length === 0) return;
    
    thumbs.forEach(thumb => {
        thumb.addEventListener('click', function() {
            // Remove active class from all thumbs
            thumbs.forEach(t => t.classList.remove('active'));
            
            // Add active class to clicked thumb
            this.classList.add('active');
            
            // Update main image with fade effect
            mainImage.style.opacity = '0.5';
            
            setTimeout(() => {
                mainImage.src = this.src;
                mainImage.alt = this.alt;
                mainImage.style.opacity = '1';
            }, 200);
        });
    });
}

function initializeLaunchGallery() {
    const mainImage = document.getElementById('mainLaunchImage');
    const thumbs = document.querySelectorAll('.launch-thumb');
    
    if (!mainImage || thumbs.length === 0) return;
    
    thumbs.forEach(thumb => {
        thumb.addEventListener('click', function() {
            // Remove active class from all thumbs
            thumbs.forEach(t => t.classList.remove('active'));
            
            // Add active class to clicked thumb
            this.classList.add('active');
            
            // Update main image with fade effect
            mainImage.style.opacity = '0.5';
            
            setTimeout(() => {
                mainImage.src = this.src;
                mainImage.alt = this.alt;
                mainImage.style.opacity = '1';
            }, 200);
        });
    });
}

// Utility Functions
function escapeHtml(text) {
    const map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    };
    return text.replace(/[&<>"']/g, function(m) { return map[m]; });
}

// Loading State Management
function showLoading(element) {
    element.classList.add('loading');
}

function hideLoading(element) {
    element.classList.remove('loading');
}

// Toast Notifications (if needed)
function showToast(message, type = 'info') {
    // Simple toast implementation
    const toast = document.createElement('div');
    toast.className = `alert alert-${type} position-fixed top-0 end-0 m-3`;
    toast.style.zIndex = '9999';
    toast.innerHTML = `
        ${message}
        <button type="button" class="btn-close" onclick="this.parentElement.remove()"></button>
    `;
    
    document.body.appendChild(toast);
    
    // Auto-remove after 5 seconds
    setTimeout(() => {
        if (toast.parentElement) {
            toast.remove();
        }
    }, 5000);
}

// Form Validation Helpers
function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

function validatePhone(phone) {
    const re = /^[\+]?[1-9][\d]{0,15}$/;
    return re.test(phone.replace(/[\s\-\(\)]/g, ''));
}

// Local Storage Helpers
function setLocalStorage(key, value) {
    try {
        localStorage.setItem(key, JSON.stringify(value));
    } catch (e) {
        console.warn('Local storage not available:', e);
    }
}

function getLocalStorage(key) {
    try {
        const item = localStorage.getItem(key);
        return item ? JSON.parse(item) : null;
    } catch (e) {
        console.warn('Local storage not available:', e);
        return null;
    }
}

// Smooth Scrolling
function smoothScrollTo(element) {
    element.scrollIntoView({
        behavior: 'smooth',
        block: 'start'
    });
}

// Initialize Bootstrap Tooltips and Popovers
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Initialize popovers
    const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    popoverTriggerList.map(function(popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });
});

// Google Maps Integration Helper
function initMap() {
    // This function is called by Google Maps API
    // Specific map initialization functions are in their respective views
    if (typeof initStoreMap === 'function') {
        initStoreMap();
    }
    if (typeof initSingleStoreMap === 'function') {
        initSingleStoreMap();
    }
}

// Expose functions globally for inline event handlers
window.showToast = showToast;
window.smoothScrollTo = smoothScrollTo;
window.initMap = initMap;