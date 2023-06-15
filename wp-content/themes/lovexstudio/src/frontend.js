import './postcss/frontend.css'
import {
	select,
	selectAll,
	inViewPort,
	addClass,
	removeClass,
	appendHtml,
	delegate,
	hasClass,
	setData
} from './js/lib/dom'
import { map } from './js/lib/utils'
import imagesLoaded from 'imagesloaded'
import { gsap } from 'gsap'
import { Fancybox } from '@fancyapps/ui'
import AOS from 'aos'

const blocks = document.querySelectorAll('[data-child-block]')
const bodyEl = select('body')
const preloaderEl = select('#preloader')

let loadedCount = 0 //current number of images loaded
let loadingProgress = 0 //timeline progress - starts at 0
let imagesToLoad = 0 //number of slides with .bcg container

let progressTl = null

if (preloaderEl) {
	progressTl = gsap.timeline({
		paused: true,
		onUpdate: progressUpdate,
		onComplete: loadComplete
	})

	progressTl
		//tween the progress bar width
		.to(select('.progress span'), {
			duration: 1,
			width: 100,
			ease: 'none'
		})
}

//as the progress bar width updates and grows we put the percentage loaded in the screen
function progressUpdate () {
	//the percentage loaded based on the tween's progress
	loadingProgress = Math.round(this.progress() * 100)
	addClass('is-loading', bodyEl)

	//we put the percentage in the screen
	const text = select('.txt-perc')
	text.innerText = loadingProgress + '%'
}

function loadComplete () {
	// preloader out
	const preloaderOutTl = gsap.timeline()

	preloaderOutTl
		.to(select('.progress'), {
			duration: 0.3,
			y: 100,
			autoAlpha: 0,
			ease: 'back.in'
		})
		.to(
			select('.txt-perc'),
			{ duration: 0.3, y: 100, autoAlpha: 0, ease: 'back.in' },
			0.1
		)
		.to(select('#preloader'), {
			duration: 0.7,
			yPercent: 100,
			ease: 'Power4.inOut'
		})
		.set(select('#preloader'), { className: 'is-hidden' })
		.then(() => {
			removeClass('is-loading', bodyEl)
		})
	return preloaderOutTl
}

const initChildBlocks = () => {
	if (blocks) {
		blocks.forEach(block => {
			const blockName = block.getAttribute('data-child-block')
			if (!blockName) {
				return
			}

			require(`./js/blocks/${blockName}.js`).default(block)
		})
	}

	const fancyboxEls = selectAll('[data-fancybox]')
	if (fancyboxEls.length > 0) {
		Fancybox.bind('[data-fancybox]')
	}

	window.scrollTo({
		top: 0
	})
}

function load () {
	if (!preloaderEl) {
		return
	}

	const imgEls = selectAll('.image__img')
	const imgViewPort = []
	let imgLoad = null

	if (!imgEls) {
		return
	}

	map(imgEl => {
		if (inViewPort(imgEl)) {
			imgViewPort.push(imgEl)
		}
	}, imgEls)

	imagesToLoad = imgViewPort.length

	if (imagesToLoad === 0) {
		return
	}

	imgLoad = imagesLoaded(imgViewPort)

	if (!imgLoad) {
		imagesToLoad = 1
		loadProgress()
	}

	imgLoad.on('progress', () => {
		loadProgress()
	})
}

function initAboutUs () {
	if (!hasClass('page-id-41', document.body)) {
		return
	}
	const galleryMoreEls = selectAll('.js-view-more-gallery')
	const widthOffset = select('.js-first-gallery').offsetWidth

	if (galleryMoreEls.length) {
		map((item, index) => {
			if (index === 0) {
				appendHtml(
					item.parentNode,
					'<button class="js-activities-button" style="margin: auto; display: block;">View More</button>'
				)
			}
			addClass('d-none', item)
		}, galleryMoreEls)

		delegate(
			'click',
			e => {
				const gallerysHiddenCurent = selectAll('.js-view-more-gallery.d-none')
				const theFirstOnece = gallerysHiddenCurent.length
					? gallerysHiddenCurent[0]
					: null

				const space = ((widthOffset - 48) / 4) * 1.5

				if (theFirstOnece) {
					removeClass('d-none', theFirstOnece)
				}

				if (gallerysHiddenCurent.length === 1) {
					addClass('d-none', e.target)
				}

				window.scrollTo({
					behavior: 'smooth',
					top:
						e.target.parentNode.getBoundingClientRect().top -
						document.body.getBoundingClientRect().top +
						space * (galleryMoreEls.length + 1 - gallerysHiddenCurent.length) +
						200
				})
			},
			'.js-activities-button',
			document.body
		)
	}
}

function loadProgress (imgLoad, image) {
	//one more image has been loaded
	loadedCount++

	loadingProgress = loadedCount / imagesToLoad

	// GSAP tween of our progress bar timeline
	gsap.to(progressTl, {
		duration: 0.7,
		progress: loadingProgress,
		ease: 'none'
	})
}

function initAos () {
	const aosEls = selectAll('.js-aos-element')
	if (aosEls.length > 0) {
		map(item => {
			setData('aos', 'fade-up', item)
		}, aosEls)
	}

	AOS.init({
		duration: 800,
		delay: 200
	})
}

document.addEventListener('DOMContentLoaded', () => {
	load()
	initChildBlocks()
	initAboutUs()
	initAos()
})
