
import './bootstrap';
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

// === GLOBAL SIDEBAR MENU SEARCH ===
document.addEventListener('DOMContentLoaded', function () {
	const searchInput = document.getElementById('globalSearch');
	const searchResults = document.getElementById('searchResults');
	if (!searchInput || !searchResults || !window.sidebarMenus) return;

	function renderResults(results) {
		searchResults.innerHTML = '';
		if (results.length === 0) {
			searchResults.style.display = 'none';
			return;
		}
		results.forEach(menu => {
			const a = document.createElement('a');
			a.className = 'list-group-item list-group-item-action';
			a.href = menu.url;
			a.innerHTML = `<i class="${menu.icon}"></i> ${menu.label}`;
			searchResults.appendChild(a);
		});
		searchResults.style.display = 'block';
	}

	searchInput.addEventListener('input', function () {
		const q = this.value.trim().toLowerCase();
		if (!q) {
			searchResults.style.display = 'none';
			return;
		}
		const filtered = window.sidebarMenus.filter(menu => menu.label.toLowerCase().includes(q));
		renderResults(filtered);
	});

	// Hide results on click outside
	document.addEventListener('click', function (e) {
		if (!searchResults.contains(e.target) && e.target !== searchInput) {
			searchResults.style.display = 'none';
		}
	});
});
