(function () {
	'use strict';

	const config = window.loddConfig || { isRtl: false, i18n: {} };
	const root = document.documentElement;
	const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
	const clamp = (value, min, max) => Math.min(Math.max(value, min), max);

	function initHeader() {
		const header = document.querySelector('[data-header]');
		if (!header) {
			return;
		}

		const toggle = header.querySelector('[data-nav-toggle]');
		const panel = header.querySelector('[data-nav-panel]');
		const label = header.querySelector('[data-nav-label]');
		let lastY = window.scrollY;

		const onScroll = () => {
			const y = window.scrollY;
			header.classList.toggle('is-scrolled', y > 40);
			if (!root.classList.contains('nav-open')) {
				header.classList.toggle('is-hidden', y > 400 && y > lastY);
			}
			lastY = y;
		};

		const setOpen = (open) => {
			root.classList.toggle('nav-open', open);
			document.body.style.overflow = open ? 'hidden' : '';
			toggle.setAttribute('aria-expanded', String(open));
			if (label) {
				label.textContent = open ? config.i18n.close : config.i18n.open;
			}
			if (open) {
				header.classList.remove('is-hidden');
				const first = panel.querySelector('a, button');
				if (first) {
					first.focus();
				}
			}
		};

		if (toggle && panel) {
			toggle.addEventListener('click', () => setOpen(!root.classList.contains('nav-open')));
			panel.addEventListener('click', (event) => {
				if (event.target.closest('a')) {
					setOpen(false);
				}
			});
			document.addEventListener('keydown', (event) => {
				if (event.key === 'Escape' && root.classList.contains('nav-open')) {
					setOpen(false);
					toggle.focus();
				}
			});
			window.matchMedia('(min-width: 1024px)').addEventListener('change', (event) => {
				if (event.matches) {
					setOpen(false);
				}
			});
		}

		header.addEventListener('focusin', () => header.classList.remove('is-hidden'));
		window.addEventListener('scroll', onScroll, { passive: true });
		onScroll();
	}

	function initHeroVideo() {
		const video = document.querySelector('[data-hero-video]');
		const toggle = document.querySelector('[data-hero-toggle]');
		if (!video || !toggle) {
			return;
		}

		const progress = toggle.querySelector('[data-hero-progress]');
		const label = toggle.querySelector('[data-hero-toggle-label]');
		let frame = null;

		const render = () => {
			if (video.duration) {
				progress.style.strokeDashoffset = String(100 - (video.currentTime / video.duration) * 100);
			}
			frame = video.paused ? null : window.requestAnimationFrame(render);
		};

		const sync = () => {
			const playing = !video.paused;
			toggle.setAttribute('aria-pressed', String(playing));
			label.textContent = playing ? config.i18n.pause : config.i18n.play;
			if (playing && !frame) {
				frame = window.requestAnimationFrame(render);
			}
		};

		toggle.addEventListener('click', () => {
			if (video.paused) {
				video.play().catch(() => {});
			} else {
				video.pause();
			}
		});

		video.addEventListener('play', sync);
		video.addEventListener('pause', sync);

		if (reduceMotion.matches) {
			video.removeAttribute('autoplay');
			video.pause();
		}

		sync();
	}

	function initReveal() {
		const items = document.querySelectorAll('[data-reveal]');
		if (!items.length) {
			return;
		}

		if (!('IntersectionObserver' in window) || reduceMotion.matches) {
			items.forEach((item) => item.classList.add('is-revealed'));
			return;
		}

		const observer = new IntersectionObserver(
			(entries) => {
				entries.forEach((entry) => {
					if (entry.isIntersecting) {
						entry.target.classList.add('is-revealed');
						observer.unobserve(entry.target);
					}
				});
			},
			{ rootMargin: '0px 0px -10% 0px', threshold: 0.12 }
		);

		items.forEach((item) => observer.observe(item));
	}

	function initDividers() {
		const dividers = document.querySelectorAll('[data-divider]');
		if (!dividers.length) {
			return;
		}

		if (!('IntersectionObserver' in window)) {
			dividers.forEach((divider) => divider.classList.add('is-inview'));
			return;
		}

		const observer = new IntersectionObserver((entries) => {
			entries.forEach((entry) => entry.target.classList.toggle('is-inview', entry.isIntersecting));
		});

		dividers.forEach((divider) => observer.observe(divider));
	}

	function initParallax() {
		const parallax = Array.from(document.querySelectorAll('[data-parallax]'));
		if (!parallax.length) {
			return;
		}

		let ticking = false;

		const update = () => {
			const vh = window.innerHeight;

			if (!reduceMotion.matches) {
				parallax.forEach((layer) => {
					const rect = layer.parentElement.getBoundingClientRect();
					if (rect.bottom < 0 || rect.top > vh) {
						return;
					}
					const limit = layer.offsetHeight * 0.05;
					const offset = clamp((rect.top + rect.height / 2 - vh / 2) * -0.06, -limit, limit);
					layer.style.transform = `translate3d(0, ${offset.toFixed(2)}px, 0)`;
				});
			}

			ticking = false;
		};

		const request = () => {
			if (!ticking) {
				ticking = true;
				window.requestAnimationFrame(update);
			}
		};

		window.addEventListener('scroll', request, { passive: true });
		window.addEventListener('resize', request);
		update();
	}

	function initAccordion() {
		document.querySelectorAll('[data-accordion]').forEach((accordion) => {
			const items = Array.from(accordion.querySelectorAll('[data-accordion-item]'));
			const triggers = items.map((item) => item.querySelector('[data-accordion-trigger]'));

			const activate = (index) => {
				items.forEach((item, i) => {
					const active = i === index;
					item.classList.toggle('is-active', active);
					triggers[i].setAttribute('aria-expanded', String(active));
				});
			};

			triggers.forEach((trigger, index) => {
				trigger.addEventListener('click', () => activate(index));
				trigger.addEventListener('keydown', (event) => {
					const keys = config.isRtl
						? { next: ['ArrowLeft', 'ArrowDown'], prev: ['ArrowRight', 'ArrowUp'] }
						: { next: ['ArrowRight', 'ArrowDown'], prev: ['ArrowLeft', 'ArrowUp'] };
					let target = null;
					if (keys.next.includes(event.key)) {
						target = (index + 1) % triggers.length;
					} else if (keys.prev.includes(event.key)) {
						target = (index - 1 + triggers.length) % triggers.length;
					} else if (event.key === 'Home') {
						target = 0;
					} else if (event.key === 'End') {
						target = triggers.length - 1;
					}
					if (target !== null) {
						event.preventDefault();
						triggers[target].focus();
					}
				});
			});
		});
	}

	function initSliders() {
		document.querySelectorAll('[data-slider]').forEach((slider) => {
			const section = slider.closest('section') || slider;
			const track = slider.querySelector('[data-slider-track]');
			const prev = section.querySelector('[data-slider-prev]');
			const next = section.querySelector('[data-slider-next]');
			if (!track) {
				return;
			}

			const direction = config.isRtl ? -1 : 1;

			const step = () => {
				const slide = track.querySelector('[data-slider-slide]');
				if (!slide) {
					return track.clientWidth;
				}
				const gap = parseFloat(getComputedStyle(track).columnGap) || 0;
				return slide.getBoundingClientRect().width + gap;
			};

			const updateButtons = () => {
				const max = track.scrollWidth - track.clientWidth;
				const position = Math.abs(track.scrollLeft);
				if (prev) {
					prev.disabled = position <= 2;
				}
				if (next) {
					next.disabled = position >= max - 2;
				}
			};

			const move = (dir) => {
				track.scrollBy({ left: dir * direction * step(), behavior: reduceMotion.matches ? 'auto' : 'smooth' });
			};

			if (prev) {
				prev.addEventListener('click', () => move(-1));
			}
			if (next) {
				next.addEventListener('click', () => move(1));
			}

			track.addEventListener('scroll', updateButtons, { passive: true });
			window.addEventListener('resize', updateButtons);

			let startX = 0;
			let startScroll = 0;
			let dragging = false;
			let moved = false;

			track.addEventListener('pointerdown', (event) => {
				if (event.pointerType !== 'mouse' || event.button !== 0) {
					return;
				}
				dragging = true;
				moved = false;
				startX = event.clientX;
				startScroll = track.scrollLeft;
			});

			window.addEventListener('pointermove', (event) => {
				if (!dragging) {
					return;
				}
				const delta = event.clientX - startX;
				if (!moved && Math.abs(delta) > 5) {
					moved = true;
					track.classList.add('is-dragging');
				}
				if (moved) {
					track.scrollLeft = startScroll - delta;
				}
			});

			window.addEventListener('pointerup', () => {
				if (!dragging) {
					return;
				}
				dragging = false;
				if (moved) {
					const snapped = Math.round(track.scrollLeft / step()) * step();
					track.classList.remove('is-dragging');
					track.scrollTo({ left: snapped, behavior: 'smooth' });
				}
			});

			track.addEventListener('click', (event) => {
				if (moved) {
					event.preventDefault();
					moved = false;
				}
			}, true);

			track.addEventListener('keydown', (event) => {
				if (event.key === 'ArrowRight' || event.key === 'ArrowLeft') {
					event.preventDefault();
					const forward = event.key === 'ArrowRight' ? 1 : -1;
					move(forward * direction);
				}
			});

			updateButtons();
		});
	}

	initHeader();
	initHeroVideo();
	initReveal();
	initDividers();
	initParallax();
	initAccordion();
	initSliders();
})();
