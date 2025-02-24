html {
    box-sizing: border-box;
    -webkit-tap-highlight-color: transparent;
}

html.boxed {
    background-color: #eee;
}

*,
*::before,
*::after {
    box-sizing: inherit;
}


/**
 * Set up a background-color and height on the root and body element.
 */

body {
    line-height: 1.5;
    font-size: 1rem;
    -webkit-font-smoothing: antialiased;
}

.config {
    overflow: hidden;
}


/**
 * Basic styles for headings and paragraph
 */

h1,
h2,
h3,
h4,
h5,
h6 {
    padding: 0;
    margin: 0;
}

h1 {
    font-size: 50px;
    line-height: 50px;
}

h2 {
    font-size: 32px;
    line-height: 46px;
}

h3 {
    font-size: 18px;
    line-height: 32px;
}

h4 {
    font-size: 16px;
    line-height: 30px;
}

h5 {
    font-size: 15px;
    line-height: 30px;
}

p {
    margin: 0;
    padding: 0;
    font-size: 14px;
    line-height: 24px;
}


/**
 * Basic styles for links
 */

a,
a:hover,
a:focus {
    outline: none;
    text-decoration: none;
    cursor: pointer;
}


/**
 * Basic style for image element
 */

img {
    border: 0;
}

img:focus {
    outline: none;
}


/**
 * Basic style for iframe element
 */

iframe {
    border: none;
    overflow: hidden;
}

iframe[src*="soundcloud"] {
    width: 100%;
}


/*--------------------------------------------------------------
Box Module
--------------------------------------------------------------*/


/* Body Element */

@media (min-width: 576px) {
    html.boxed body {
        background-color: #ffffff;
        margin: 0 auto;
    }
}

@media (min-width: 576px) {
    html.boxed body {
        max-width: 546px;
    }
}

@media (min-width: 791px) {
    html.boxed body {
        max-width: 770px;
    }
}

@media (min-width: 1025px) {
    html.boxed body {
        max-width: 990px;
    }
    .menu-init .toggle-mega-text svg {
        fill: #fff;
        padding: 8px;
    }
}

@media (min-width: 1230px) {
    html.boxed body {
        max-width: 1200px;
    }
}


/* Header with container Element */

@media (max-width: 1024px) {
    html.boxed header .container {
        padding-left: 20px;
        padding-right: 20px;
    }
}

@media (min-width: 1025px) {
    html.boxed header .container {
        padding-left: 40px;
        padding-right: 40px;
    }
}


/* Header & Footer Element */

@media (min-width: 576px) {
    html.boxed header,
    html.boxed footer {
        margin-right: auto;
        margin-left: auto;
        width: 100%;
    }
}

@media (min-width: 576px) {
    html.boxed header,
    html.boxed footer {
        max-width: 456px;
    }
}

@media (min-width: 791px) {
    html.boxed header,
    html.boxed footer {
        max-width: 770px;
    }
}

@media (min-width: 1025px) {
    html.boxed header,
    html.boxed footer {
        max-width: 990px;
    }
}

@media (min-width: 1230px) {
    html.boxed header,
    html.boxed footer {
        max-width: 1200px;
    }
}


/* App Content exclude Header & Footer */

@media (min-width: 576px) {
    html.boxed .app-content {
        margin: 0 auto;
        overflow: hidden;
    }
}

@media (min-width: 576px) {
    html.boxed .app-content {
        max-width: 546px;
    }
}

@media (min-width: 791px) {
    html.boxed .app-content {
        max-width: 770px;
    }
}

@media (min-width: 1025px) {
    html.boxed .app-content {
        max-width: 990px;
    }
}

@media (min-width: 1230px) {
    html.boxed .app-content {
        max-width: 1200px;
    }
}


/* App Content with container */

@media (max-width: 1024px) {
    html.boxed .app-content .container {
        padding-left: 20px;
        padding-right: 20px;
    }
}

@media (min-width: 1025px) {
    html.boxed .app-content .container {
        padding-left: 40px;
        padding-right: 40px;
    }
    .menu-init button {
        display: none;
    }
}


/* Footer with container Element */

@media (max-width: 1024px) {
    html.boxed footer .container {
        padding-left: 20px;
        padding-right: 20px;
    }
}

@media (min-width: 1025px) {
    html.boxed footer .container {
        padding-left: 40px;
        padding-right: 40px;
    }
}


/*--------------------------------------------------------------
2.0 Typography
--------------------------------------------------------------*/


/**
 * Basic typography style for copy text
 */

body {
    color: #7f7f7f;
    font-family: "Open Sans", -apple-system, system-ui, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
}


/*--------------------------------------------------------------
3.0 Pre-configured styles
--------------------------------------------------------------*/


/**
* JavaScript Disabled Page
*/

.no-js #app {
    display: none;
}

.app-setting {
    background-color: #ffffff;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: center;
    align-items: center;
    height: 100vh;
    position: fixed;
    z-index: 1000001;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
}

.app-setting__wrap {
    text-align: center;
    padding: 2.1875rem;
    background-color: #fbfbfb;
    border-left: 0.1875rem solid #1275C6;
}

.app-setting__h1 {
    font-size: 2.0625rem;
    font-weight: 700;
    line-height: 42px;
    color: #333333;
}

.app-setting__text {
    font-size: 0.8125rem;
    color: #ababab;
}


/**
* Preloader
*/

.preloader.is-active {
    width: 100%;
    text-align: center;
    height: 100%;
    position: fixed;
    left: 0;
    top: 0;
    z-index: 1000000;
    background: white;
    display: block;
}

.preloader {
    display: none;
}

.preloader__wrap {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: center;
    align-items: center;
    -ms-flex-pack: center;
    justify-content: center;
    height: 100%;
}

.preloader__img {
    display: block;
}


/*
  * Row modifier class
 */

.row--center {
    -ms-flex-pack: center;
    justify-content: center;
}


/*
  * Fitvids plugin modifier class
 */

.fluid-width-video-wrapper {
    background-color: #f5f5f5;
}


/*
  * Social media classes with property background-color & color.
  * 's' is a prefix and represents a social media class.
 */


/* Facebook */

.s-fb--bgcolor-hover:hover {
    background-color: #4267b2;
}

.s-fb--color-hover:hover {
    color: #4267b2;
}

.s-fb--color {
    color: #4267b2;
}


/* Twitter */

.s-tw--bgcolor-hover:hover {
    background-color: #38A1F3;
}

.s-tw--color-hover:hover {
    color: #38A1F3;
}

.s-tw--color {
    color: #38A1F3;
}


/* instagram */

.s-insta--bgcolor-hover:hover {
    background-color: #f77737;
}

.s-insta--color-hover:hover {
    color: #f77737;
}

.s-insta--color {
    color: #f77737;
}


/* youtube */

.s-youtube--bgcolor-hover:hover {
    background-color: #ED3833;
}

.s-youtube--color-hover:hover {
    color: #ED3833;
}

.s-youtube--color {
    color: #ED3833;
}


/* linkedin */

.s-linked--bgcolor-hover:hover {
    background-color: #0077B5;
}

.s-linked--color-hover:hover {
    color: #0077B5;
}

.s-linked--color {
    color: #0077B5;
}


/* googleplus */

.s-gplus--bgcolor-hover:hover {
    background-color: #dd4b39;
}

.s-gplus--color-hover:hover {
    color: #dd4b39;
}

.s-gplus--color {
    color: #dd4b39;
}


/* Whats App */

.s-wa--color {
    color: #25d366;
}

.s-wa--color-hover:hover {
    color: #25d366;
}


/*
  * Global classes you can use these classes on elements and components of your application.
  * Remember: Don't confuse your mind with utility classes & Global classes.
  * Utility class has a prefix 'u' that represents root namespace also has a sub-namespace
  * prefix. These are low-level utility classes that make it easy to build complex user interfaces.
  * Global class has a prefix 'gl' and these classes are ready-made styles that you could
  * use on different elements like span, div, h1, h3 and components like button, selectbox. scrollbar etc.
 */


/*
  * Chrome Default Style for scrollbar
 */

.gl-scroll::-webkit-scrollbar {
    height: 8px;
    width: 8px;
}

.gl-scroll::-webkit-scrollbar-track {
    background: #eee;
}

.gl-scroll::-webkit-scrollbar-thumb {
    background: #888;
}

.gl-scroll::-webkit-scrollbar-thumb:hover {
    background: #555;
}


/*
  * Global Rating Style apply on any div that has `i` element as children
 */

.gl-rating-style>i {
    margin-left: 2px;
    color: #ff9600;
}

.gl-rating-style>i:first-child {
    margin-left: 0;
}

.gl-rating-style-2>i {
    margin-left: 2px;
    color: #ff9600;
}

.gl-rating-style-2>i:first-child {
    margin-left: 0;
}


/*
  * Signup, Login Social Buttons
 */

.gl-s-api {
    width: 80%;
    margin: 0 auto;
}

.gl-s-api__btn {
    border: none;
    cursor: pointer;
    text-align: center;
    display: block;
    width: 100%;
    padding: 12px;
    color: #ffffff;
    font-size: 14px;
    font-weight: 600;
    transition: background-color 0.5s linear;
}

.gl-s-api__btn:focus {
    outline: 0;
}

.gl-s-api__btn span {
    margin-left: 10px;
}

.gl-s-api__btn--fb {
    background-color: #4267b2;
}

.gl-s-api__btn--fb:hover {
    background-color: #3b5c9f;
}

.gl-s-api__btn--gplus {
    background-color: #dd4b39;
}

.gl-s-api__btn--gplus:hover {
    background-color: #d73925;
}


/*
 * Inline Maker 1
  */

.gl-inline {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: nowrap;
    flex-wrap: nowrap;
    -ms-flex-align: center;
    align-items: center;
}

.gl-inline div {
    -ms-flex: 1;
    flex: 1;
    margin-right: 14px;
}

.gl-inline div:last-child {
    margin-right: 0;
}


/*
* Inline Maker 2
 */

.gl-l-r {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: center;
    align-items: center;
    -ms-flex-pack: justify;
    justify-content: space-between;
}


/**
  * DOB: Date of Birth Select Box
 */

.gl-dob {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: center;
    align-items: center;
}

.gl-dob .select-box {
    -ms-flex: 1;
    flex: 1;
    margin-right: 8px;
}

.gl-dob .select-box:last-child {
    margin-right: 0;
}

.gl-link {
    font-size: 13px;
    font-weight: 600;
    color: #1275C6;
    transition: color 0.5s linear;
}

.gl-link:hover {
    color: #fa4400;
}

.gl-h1 {
    color: #333333;
    font-size: 18px;
    margin-bottom: 8px;
}

.gl-text {
    display: block;
    color: #a0a0a0;
    font-size: 13px;
}

.gl-label {
    margin-bottom: 8px;
    display: block;
    color: #333333;
    font-size: 13px;
    font-weight: 600;
}


/**
* Global Tag
 */

.gl-tag {
    margin-right: 8px;
    display: inline-block;
    margin-bottom: 10px;
    padding: 5px 13px;
    font-size: 12px;
    font-weight: 600;
    border-radius: 22px;
}

.gl-tag:last-child {
    margin-right: 0;
}


/*
* Global Modal Classes
 */

.gl-modal-h1 {
    margin-bottom: 8px;
    line-height: 1;
    display: block;
    color: #333333;
    font-size: 20px;
    font-weight: 600;
}

.gl-modal-text {
    color: #a0a0a0;
    font-size: 13px;
}

.gl-modal-btn-group {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: center;
    align-items: center;
}

.gl-modal-btn-group button {
    margin-right: 12px;
}

.gl-modal-btn-group button:last-child {
    margin-right: 0;
}

@media (max-width: 575px) {
    .gl-inline {
        display: block;
    }
    .gl-inline div {
        display: block;
        margin-right: 0;
    }
    .gl-l-r {
        display: block;
    }
    .gl-dob {
        display: block;
    }
    .gl-dob .select-box {
        width: 100%;
        margin-bottom: 8px;
        margin-right: 0;
    }
    .gl-dob .select-box:last-child {
        margin: 0;
    }
}


/**
  * Default Pulse Animation
 */

@-webkit-keyframes mypulse {
    0% {
        box-shadow: 0 0 0 0 #bdc3c7;
    }
    100% {
        box-shadow: 0 0 0 1.5em rgba(189, 195, 199, 0);
    }
}

@keyframes mypulse {
    0% {
        box-shadow: 0 0 0 0 #bdc3c7;
    }
    100% {
        box-shadow: 0 0 0 1.5em rgba(189, 195, 199, 0);
    }
}


/*--------------------------------------------------------------
4.0 Layout Utility Styles
--------------------------------------------------------------*/


/**
 * Utility classes for colors:
 * Convey meaning through color with a handful of color utility classes.
 * Includes support for styling links too.
 */

.u-c-brand {
    color: #1275C6 !important;
}

.u-c-secondary {
    color: #333333 !important;
}

.u-c-white {
    color: #ffffff !important;
}

.u-c-black {
    color: #000000 !important;
}

.u-c-grey {
    color: #7f7f7f !important;
}

.u-c-silver {
    color: #a0a0a0 !important;
}


/*
  * Display Utility
 */

.u-d-block {
    display: block;
}


/*
  * Sizing
  * Easily make an element as wide or as tall (relative to its parent) with our width and height utilities.
 */

.u-w-100 {
    width: 100%;
}

.u-h-100 {
    height: 100%;
}


/**
  * Image Responsive utility classes
 */

.u-img-fluid {
    width: 100%;
    max-width: 100%;
    height: auto;
}


/*--------------------------------------------------------------
5.0 Components
--------------------------------------------------------------*/


/* Breadcrumb Component */

.breadcrumb__wrap {
    background-color: #fbfbfb;
    padding: 1.125rem;
    border-radius: 0.1875rem;
}

.breadcrumb__list {
    list-style: none;
    padding: 0;
    margin: 0;
    word-wrap: break-word;
}

.breadcrumb__list>li {
    display: inline-block;
}

.breadcrumb__list>li>a {
    color: #a0a0a0;
    font-size: 13px;
    font-weight: 700;
    transition: color 0.5s;
}

.breadcrumb__list>li>a:hover {
    color: #333333;
}

.breadcrumb__list>li.is-marked>a {
    color: #333333;
}

.breadcrumb__list>li.has-separator:after {
    content: '/';
    margin: 0 16px;
}


/* Button Component */

.btn {
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    cursor: pointer;
    font-size: 14px;
}

.btn:focus {
    outline: none;
}

.btn--icon {
    border: none;
    background-color: transparent;
    padding: 0;
}

.btn--e-brand {
    color: #ffffff;
    border: 1px solid transparent;
    background-color: #ff4500;
    transition: background-color .5s ease-in;
}

.btn--e-brand:hover {
    background-color: #ff4500;
}

.btn--e-brand-b-2 {
    color: #ffffff;
    background-color: #1275C6;
    border: 2px solid #1275C6;
    transition: background-color 0.5s ease-in, border-color 0.5s ease-in;
}

.btn--e-brand-b-2:hover {
    background-color: #1275C6;
    border-color: #1275C6;
}

.btn--e-grey-b-2 {
    color: #333333;
    background-color: #f5f5f5;
    border: 2px solid #f5f5f5;
    transition: background-color 0.5s ease-in, border-color 0.5s ease-in;
}

.btn--e-grey-b-2:hover {
    background-color: #f2f2f2;
    border-color: #f2f2f2;
}

.btn--e-secondary {
    color: #ffffff;
    border: 1px solid transparent;
    background-color: #333333;
    transition: background-color .5s ease-in;
}

.btn--e-secondary:hover {
    background-color: #303030;
}

.btn--e-white-brand {
    border: 1px solid transparent;
    color: #333333;
    background-color: #ffffff;
    transition: background-color .3s linear, color .3s linear;
}

.btn--e-white-brand:hover {
    background-color: #1275C6;
    color: #ffffff;
}

.btn--e-transparent-brand-b-2 {
    color: #1275C6;
    border: 2px solid #1275C6;
    background-color: transparent;
    transition: border-color .5s ease-in;
}

.btn--e-transparent-brand-b-2:hover {
    border-color: #fa4400;
}

.btn--e-transparent-hover-brand-b-2 {
    color: #1275C6;
    border: 2px solid #1275C6;
    background-color: transparent;
    transition: background-color .1s ease-in, border-color .1s ease-in;
}

.btn--e-transparent-hover-brand-b-2:hover {
    background-color: #1275C6;
    color: #ffffff;
}

.btn--e-transparent-secondary-b-2 {
    color: #333333;
    border: 2px solid #333333;
    background-color: transparent;
    transition: border-color .5s ease-in;
}

.btn--e-transparent-secondary-b-2:hover {
    border-color: #303030;
}

.btn--e-transparent-platinum-b-2 {
    color: #333333;
    border: 2px solid #e5e5e5;
    background-color: transparent;
    transition: border-color 0.5s linear;
}

.btn--e-transparent-platinum-b-2:hover {
    border-color: #1275C6;
}

.btn--e-white-brand-shadow {
    border: 1px solid #eee;
    box-shadow: 1px 2px 8px 0 rgba(36, 37, 38, 0.08);
    background-color: #ffffff;
    color: #333333;
    transition: background-color .3s linear, border-color .3s linear, color .3s linear;
}

.btn--e-white-brand-shadow:hover {
    border-color: #1275C6;
    background-color: #1275C6;
    color: #ffffff;
}

.btn--e-brand-shadow {
    border: 1px solid #1275C6;
    box-shadow: 1px 2px 8px 0 rgba(36, 37, 38, 0.08);
    background-color: #1275C6;
    color: #ffffff;
    transition: background-color .3s linear, border-color .3s linear;
}

.btn--e-brand-shadow:hover {
    border-color: #fa4400;
    background-color: #fa4400;
}


/* Countdown Component */

.countdown--style-special {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    -ms-flex-pack: center;
    justify-content: center;
}

.countdown--style-special .countdown__content {
    margin: 0 6px 12px;
    text-align: center;
    padding: 0px 12px;
    background-color: rgba(255, 255, 255, 0.98);
    border-radius: 10px;
}

.countdown--style-special .countdown__value {
    font-size: 32px;
    font-weight: 600;
    display: block;
    color: #333333;
}

.countdown--style-special .countdown__key {
    font-size: 12px;
    font-weight: 600;
    display: block;
    color: #1275C6;
}

.countdown--style-banner {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    -ms-flex-pack: center;
    justify-content: center;
}

.countdown--style-banner .countdown__content {
    margin: 0 10px 10px;
    text-align: center;
    padding: 5px 24px;
    background-color: #333333;
}

.countdown--style-banner .countdown__value {
    font-size: 48px;
    font-weight: 600;
    display: block;
    color: #ffffff;
}

.countdown--style-banner .countdown__key {
    font-size: 12px;
    font-weight: 600;
    display: block;
    color: #ffffff;
}

.countdown--style-section {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-pack: center;
    justify-content: center;
    -ms-flex-align: center;
    align-items: center;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
}

.countdown--style-section .countdown__content {
    margin: 18px 20px 20px 0;
    padding: 8px 22px;
    box-shadow: 0 0 8px 0 rgba(0, 0, 0, 0.06);
    background-color: rgba(255, 255, 255, 0.98);
}

.countdown--style-section .countdown__value {
    font-size: 26px;
    font-weight: 600;
    display: block;
    color: #333333;
}

.countdown--style-section .countdown__key {
    font-size: 10px;
    font-weight: 600;
    display: block;
    color: #1275C6;
}


/* Input-Counter Component */

.input-counter {
    position: relative;
    display: inline-block;
    max-width: 132px;
    min-width: 132px;
}

.input-counter__text {
    border-radius: 25px;
    display: block;
    width: 100%;
    height: 50px;
    font-size: 14px;
    font-weight: 600;
    text-align: center;
}

.input-counter__text:focus {
    outline: 0;
}

.input-counter--text-primary-style {
    color: #333333;
    transition: all 0.6s linear;
    border: 2px solid transparent;
    background-color: #f1f1f1;
}

.input-counter--text-primary-style:focus {
    background-color: transparent;
    border-color: #1275C6;
}

.input-counter__minus,
.input-counter__plus {
    top: 0;
    display: inline-block !important;
    font-size: 10px;
    cursor: pointer;
    position: absolute;
    width: 50px;
    line-height: 50px !important;
    height: 100%;
    text-align: center;
    color: #7f7f7f;
    transition: color 0.5s;
}

.input-counter__minus:hover,
.input-counter__plus:hover {
    color: #333333;
}

.input-counter__minus {
    left: 0;
}

.input-counter__plus {
    right: 0;
}


/* Input Text Component */

.input-text {
    font-size: 12px;
    background-clip: padding-box;
    padding: 0 18px;
    height: 40px;
}

.input-text--border-radius {
    border-radius: 25px;
}

.input-text--primary-style {
    color: #333333;
    transition: all 0.6s linear;
    border: 2px solid transparent;
    background-color: #f1f1f1;
}

.input-text--primary-style:focus {
    background-color: transparent;
    border-color: #1275C6;
}

.input-text--style-1 {
    color: #5c636c;
    transition: all 0.6s linear;
    border: 1px solid transparent;
    background-color: #f1f1f1;
}

.input-text--style-1:focus {
    box-shadow: 0 0 15px 0 rgba(0, 0, 0, 0.1);
    background-color: transparent;
    border-color: #eee;
}

.input-text--style-2 {
    color: #5c636c;
    border: 1px solid transparent;
    background-color: #f1f1f1;
    transition: all 0.6s linear;
}

.input-text--style-2:focus {
    background-color: #ffffff;
}

.input-text--only-white {
    border: 1px solid transparent;
    color: #333333;
    background-color: #ffffff;
}

.input-text:focus {
    outline: 0;
}

.input-text:disabled {
    background-color: #cecece;
}

input::-ms-clear {
    display: none;
}


/* Preload Aspect Ratio Component */


/*
  * Example 1 For Square: <a class="aspect aspect--bg-grey aspect--square u-d-block"><img src="a.jpg" class="aspect__img" alt=""></a>
  * Example 2 For Non Square: <div class="aspect aspect--bg-grey aspect--1286-890"><img src="a.jpg" class="aspect__img" alt=""></div>
 */


/*
  * Some Points to use Aspect Ratio Component classes:
  * Make sure the element on which it adds, it would be a block or inline-block element,
  * if it is not then you could add utility class 'u-d-block', 'u-d-inline-block' or you
  * could directly target that element with CSS to make inline or block.
  * By default '.aspect--square' or '.aspect--16:9: resolution' class takes height according to
  * the height of the child image element.
  * But if the parent element is a flex element then aspect ratio technique doesn't work because
  * '.aspect--square' or '.aspect--16:9: resolution' contains padding top/bottom property with a
  * percentage value.
  * There are also some cases you do not want to have '.aspect--square' or '.aspect--16:9: resolution'
  * class to take width & height that match with child image element.
  * Then you could append CSS class or directly target that parent element with CSS and
  * set your custom width & height.
  * If the image has aspect ratio square, i.e. 4:3 then you would add class '.aspect--square'
  * on the element. This class has a padding-bottom:100% property.
  * 100% means to take the entire height of the image.
  * If the image doesn't have aspect ratio square then to make a custom class
  * like '.aspect--imageWidth-imageHeight' and use ready-made sass function() nonsquare(imageWidth,imageHeight)
  * that returns padding-bottom property with the value calculated according to image resolution.
  * You could also change the background-color of placeholder according to your own choice.
  * By default, only 2 classes are generated.
 */

.aspect {
    position: relative;
}

.aspect--bg-grey {
    background-color: #f5f5f5;
}

.aspect--bg-grey-fb {
    background-color: #fbfbfb;
}

.aspect--square {
    padding-bottom: 100%;
}


/*
  * Add this class inside '.aspect' child image element. If you want to make an image responsive then
  * you can use utility u-img-fluid class.
 */

.aspect__img {
    position: absolute;
    width: 100%;
    height: 100%;
}


/* Product Component */

.product-o {
    padding: 20px;
    background-color: #ffffff;
}

.product-o--hover-off {
    box-shadow: 0 0 21px 0 rgba(0, 0, 0, 0.1);
}

.product-o--radius {
    border-radius: 14px;
}

.product-o--hover-on {
    transition: all 0.4s ease-in-out;
}

.product-o--hover-on:hover {
    box-shadow: 0 0 21px 0 rgba(0, 0, 0, 0.1);
}

.product-o__wrap a {
    border-radius: 20px;
}

.product-o__wrap a img {
    border-radius: 20px;
}

.product-o:hover .product-o__wrap:before {
    opacity: 1;
}

.product-o:hover .product-o__action-wrap {
    opacity: 1;
    -webkit-transform: translateY(-50%) scale(1);
    transform: translateY(-50%) scale(1);
}

.product-o:hover .product-o__action-list>li {
    opacity: 1;
    -webkit-transform: translateY(0);
    transform: translateY(0);
}

.product-o__wrap {
    position: relative;
}

.product-o__wrap:before {
    content: "";
    background: rgba(0, 0, 0, 0.5);
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 1;
    opacity: 0;
    transition: all 400ms cubic-bezier(0.175, 0.885, 0.32, 1.275);
    border-radius: 20px;
}

.product-o__action-wrap {
    width: 100%;
    position: absolute;
    top: 50%;
    left: 0;
    opacity: 0;
    z-index: 2;
    -webkit-transform: translateY(-50%) scale(0.8);
    transform: translateY(-50%) scale(0.8);
    transition: all 0.2s ease 0s;
}

.product-o__action-list {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-pack: center;
    justify-content: center;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin: 0;
    padding: 0;
    list-style: none;
}

.product-o__action-list>li {
    margin: 0 4px 6px;
    opacity: 0;
    -webkit-transform: translateY(50%);
    transform: translateY(50%);
    transition: all 0.3s ease 0.1s;
}

.product-o__action-list>li>a {
    display: block;
    width: 35px;
    text-align: center;
    border-radius: 50%;
    height: 35px;
    line-height: 35px;
    background-color: rgba(255, 255, 255, 0.25);
    color: #ffffff;
    font-size: 12px;
    transition: all 0.3s ease 0s;
}

.product-o__action-list>li>a:hover {
    background-color: #333333;
    color: #ffffff;
}

.product-o__category {
    display: block;
    margin-top: 4px;
}

.product-o__category>a {
    color: #a0a0a0;
    transition: color 0.5s;
    font-size: 12px;
}

.product-o__category>a:hover {
    color: #1275C6;
}

.product-o__name>a {
    color: #333333;
    font-size: 14px;
    font-weight: 600;
    transition: color 0.5s;
}

.product-o__name>a:hover {
    color: #1275C6;
}

.product-o__rating {
    margin-bottom: 4px;
}

.product-o__rating i {
    font-size: 12px;
}

.product-o__review {
    margin-left: 4px;
    font-size: 12px;
    color: #a0a0a0;
}

.product-o__price {
    display: block;
    color: #333333;
    font-size: 14px;
    font-weight: 600;
}

.product-o__discount {
    font-weight: 600;
    margin-left: 30px;
    color: #333333;
    font-size: 14px;
    text-decoration: line-through;
}

.product-o__countdown-wrap {
    margin-top: 16px;
}

.product-o__special-count-wrap {
    position: absolute;
    width: 100%;
    bottom: 20px;
}

.x-product {
    padding: 20px;
    border-radius: 6px;
    transition: -webkit-transform 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    transition: transform 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    transition: transform 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55), -webkit-transform 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    box-shadow: 0 0 8px 0 rgba(0, 0, 0, 0.06);
}

.x-product .row {
    -ms-flex-align: center;
    align-items: center;
}

.x-product__feature-list {
    margin: 0;
    padding: 0;
    list-style: none;
}

.x-product:hover {
    -webkit-transform: translateY(-6px);
    transform: translateY(-6px);
}

.feature {
    margin-bottom: 20px;
}

.feature__name {
    color: #333333;
    font-size: 13px;
    font-weight: 600;
    display: block;
}

.feature__value {
    color: #7f7f7f;
    font-size: 12px;
    display: block;
}

.product-l {
    display: -ms-flexbox;
    display: flex;
}

.product-l__img-wrap {
    margin-right: 20px;
}

.product-l__rating i {
    font-size: 12px;
}

.product-l__link {
    width: 110px;
    height: 110px;
}

.product-l__category {
    display: block;
}

.product-l__category>a {
    color: #a0a0a0;
    transition: color 0.5s;
    font-size: 12px;
}

.product-l__category>a:hover {
    color: #1275C6;
}

.product-l__name {
    display: block;
    margin-bottom: 4px;
}

.product-l__name>a {
    color: #333333;
    font-size: 14px;
    font-weight: 600;
    transition: color 0.5s;
}

.product-l__name>a:hover {
    color: #1275C6;
}

.product-l__price {
    display: block;
    color: #333333;
    font-size: 14px;
    font-weight: 600;
}

.product-l__discount {
    font-weight: 600;
    margin-left: 15px;
    color: #fa4500;
    font-size: 14px;
    text-decoration: line-through;
}

.product-o2 {
    background-color: #ffffff;
    box-shadow: 0 0 8px 0 rgba(0, 0, 0, 0.06);
}

.product-o2__wrap {
    position: relative;
    overflow: hidden;
}

.product-o2__action-wrap {
    position: absolute;
    z-index: 2;
    opacity: 0;
    transition: all 0.6s linear;
    left: 20px;
    top: 20px;
}

.product-o2__action-list {
    margin: 0;
    padding: 0;
    text-align: center;
    list-style: none;
}

.product-o2__action-list>li {
    margin-bottom: 6px;
}

.product-o2__action-list>li>a {
    display: inline-block;
    width: 35px;
    text-align: center;
    border-radius: 50%;
    height: 35px;
    line-height: 35px;
    background-color: #1275C6;
    color: #ffffff;
    font-size: 12px;
    transition: all 0.3s ease 0.1s;
}

.product-o2__action-list>li>a:hover {
    background-color: #ffffff;
    color: #1275C6;
}

.product-o2__action-list>li:last-child {
    margin-bottom: 0;
}

.product-o2__countdown-wrap {
    position: absolute;
    right: 0;
    top: 0;
    background-color: rgba(0, 0, 0, 0.6);
    width: 60px;
    height: 100%;
}

.product-o2__img {
    transition: all 0.6s ease-in-out;
    -webkit-transform: scale(1);
    transform: scale(1);
}

.product-o2__content {
    padding: 10px;
}

.product-o2__category {
    display: block;
    margin-top: 4px;
}

.product-o2__category>a {
    color: #a0a0a0;
    transition: color 0.5s;
    font-size: 12px;
}

.product-o2__category>a:hover {
    color: #1275C6;
}

.product-o2__name {
    display: block;
}

.product-o2__name>a {
    color: #333333;
    font-size: 14px;
    font-weight: 600;
    transition: color 0.5s;
}

.product-o2__name>a:hover {
    color: #1275C6;
}

.product-o2__rating {
    margin-bottom: 4px;
}

.product-o2__rating i {
    font-size: 12px;
}

.product-o2__review {
    margin-left: 4px;
    font-size: 12px;
    color: #a0a0a0;
}

.product-o2__price {
    display: block;
    color: #333333;
    font-size: 14px;
    font-weight: 600;
}

.product-o2__discount {
    font-weight: 600;
    margin-left: 30px;
    color: #333333;
    font-size: 14px;
    text-decoration: line-through;
}

.product-o2:hover .product-o2__img {
    -webkit-transform: scale(1.1);
    transform: scale(1.1);
}

.product-o2:hover .product-o2__action-wrap {
    opacity: 1;
}

.product-r {
    border-radius: 15px;
    overflow: hidden;
    background-color: #ffffff;
    transition: -webkit-transform 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    transition: transform 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    transition: transform 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55), -webkit-transform 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    box-shadow: 2px 2px 8px 3px rgba(36, 37, 38, 0.08);
}

.product-r__container {
    position: relative;
}

.product-r__ribbon-wrap {
    position: absolute;
    top: 0;
    right: 25px;
}

.product-r__action-wrap {
    width: 100%;
    position: absolute;
    top: 50%;
    left: 0;
    opacity: 0;
    z-index: 2;
    -webkit-transform: translateY(-50%) scale(0.8);
    transform: translateY(-50%) scale(0.8);
    transition: all 0.2s ease 0s;
}

.product-r__action-list {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-pack: center;
    justify-content: center;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin: 0;
    padding: 0;
    list-style: none;
}

.product-r__action-list>li {
    margin: 0 4px 6px;
    opacity: 0;
    -webkit-transform: translateY(50%);
    transform: translateY(50%);
    transition: all 0.3s ease 0.1s;
}

.product-r__action-list>li>a {
    display: block;
    width: 35px;
    text-align: center;
    border-radius: 50%;
    height: 35px;
    line-height: 35px;
    background-color: #ffffff;
    color: #1275C6;
    box-shadow: 0 0 8px 0 rgba(0, 0, 0, 0.06);
    font-size: 12px;
    transition: all 0.3s ease 0s;
}

.product-r__action-list>li>a:hover {
    background-color: #ffffff;
    color: #1275C6;
}

.product-r__info-wrap {
    padding: 14px;
}

.product-r__category {
    display: block;
    margin-bottom: 2px;
}

.product-r__category>a {
    color: #a0a0a0;
    transition: color 0.5s;
    font-size: 12px;
}

.product-r__category>a:hover {
    color: #1275C6;
}

.product-r__n-p-wrap {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-pack: justify;
    justify-content: space-between;
    margin-bottom: 6px;
}

.product-r__name,
.product-r__price {
    -ms-flex: 0 1 auto;
}

.product-r__name {
    display: block;
}

.product-r__name>a {
    color: #333333;
    font-size: 14px;
    font-weight: 600;
    transition: color 0.5s;
}

.product-r__name>a:hover {
    color: #1275C6;
}

.product-r__price {
    display: block;
    font-weight: 600;
    color: #1275C6;
    font-size: 16px;
}

.product-r__description {
    margin-bottom: 6px;
    display: block;
    color: #7f7f7f;
    font-size: 12px;
}

.product-r:hover {
    -webkit-transform: translateY(-6px);
    transform: translateY(-6px);
}

.product-r:hover .product-r__action-wrap {
    opacity: 1;
    -webkit-transform: translateY(-50%) scale(1);
    transform: translateY(-50%) scale(1);
}

.product-r:hover .product-r__action-list>li {
    opacity: 1;
    -webkit-transform: translateY(0);
    transform: translateY(0);
}

.product-bs {
    background-color: #ffffff;
    box-shadow: 0 0 8px 0 rgba(0, 0, 0, 0.06);
    transition: -webkit-transform 0.7s ease-in-out;
    transition: transform 0.7s ease-in-out;
    transition: transform 0.7s ease-in-out, -webkit-transform 0.7s ease-in-out;
}

.product-bs__container {
    padding: 20px;
}

.product-bs__wrap {
    position: relative;
    margin-bottom: 4px;
}

.product-bs__action-wrap {
    width: 100%;
    position: absolute;
    top: 50%;
    left: 0;
    opacity: 0;
    z-index: 2;
    -webkit-transform: translateY(-50%) scale(0.8);
    transform: translateY(-50%) scale(0.8);
    transition: all 0.2s ease 0s;
}

.product-bs__action-list {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-pack: center;
    justify-content: center;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin: 0;
    padding: 0;
    list-style: none;
}

.product-bs__action-list>li {
    margin: 0 4px 6px;
    opacity: 0;
    -webkit-transform: translateY(50%);
    transform: translateY(50%);
    transition: all 0.3s ease 0.1s;
}

.product-bs__action-list>li>a {
    display: block;
    width: 35px;
    text-align: center;
    border-radius: 50%;
    height: 35px;
    line-height: 35px;
    background-color: #1275C6;
    color: #ffffff;
    font-size: 12px;
    transition: all 0.3s ease 0s;
}

.product-bs__action-list>li>a:hover {
    box-shadow: 0 0 8px 0 rgba(0, 0, 0, 0.06);
    background-color: #ffffff;
    color: #1275C6;
}

.product-bs__category {
    display: block;
}

.product-bs__category>a {
    color: #a0a0a0;
    transition: color 0.5s;
    font-size: 12px;
}

.product-bs__category>a:hover {
    color: #1275C6;
}

.product-bs__name {
    display: block;
}

.product-bs__name>a {
    color: #333333;
    font-size: 14px;
    font-weight: 600;
    transition: color 0.5s;
}

.product-bs__name>a:hover {
    color: #1275C6;
}

.product-bs__rating {
    margin-bottom: 4px;
}

.product-bs__rating i {
    font-size: 12px;
}

.product-bs__review {
    margin-left: 4px;
    font-size: 12px;
    color: #a0a0a0;
}

.product-bs__price {
    display: block;
    color: #333333;
    font-size: 14px;
    font-weight: 600;
}

.product-bs__discount {
    font-weight: 600;
    margin-left: 30px;
    color: #333333;
    font-size: 14px;
    text-decoration: line-through;
}

.product-bs:hover {
    -webkit-transform: translateY(-8px);
    transform: translateY(-8px);
}

.product-bs:hover .product-bs__action-wrap {
    opacity: 1;
    -webkit-transform: translateY(-50%) scale(1);
    transform: translateY(-50%) scale(1);
}

.product-bs:hover .product-bs__action-list>li {
    opacity: 1;
    -webkit-transform: translateY(0);
    transform: translateY(0);
}

.product-short {
    background-color: #fbfbfb;
    transition: -webkit-transform 0.7s ease-in-out;
    transition: transform 0.7s ease-in-out;
    transition: transform 0.7s ease-in-out, -webkit-transform 0.7s ease-in-out;
}

.product-short:hover {
    -webkit-transform: translateY(-8px);
    transform: translateY(-8px);
}

.product-short__container {
    padding: 30px;
}

.product-short__info {
    margin-top: 14px;
}

.product-short__price {
    display: block;
    font-size: 12px;
    font-weight: 600;
    color: #1275C6;
}

.product-short__name {
    display: block;
}

.product-short__name>a {
    font-size: 14px;
    font-weight: 600;
    color: #333333;
    transition: color 0.5s;
}

.product-short__name>a:hover {
    color: #1275C6;
}

.product-short__category {
    display: block;
}

.product-short__category>a {
    font-size: 11px;
    color: #a0a0a0;
    transition: color 0.5s;
}

.product-short__category>a:hover {
    color: #1275C6;
}


/* Checkbox, Radio Component */


/*
  * Remember these are very important styles and make sure input checkbox always has a greater z-index from label
  * and any other div's.
  * Remember these styles make checkbox horizontal center, and when you click out of the boundary region
  * Behind the scenes checkbox has a opacity 0 but it will be checked.
 */

.check-box [type="checkbox"] {
    position: absolute;
    left: 0;
    top: 0;
    min-width: 16px;
    width: 100%;
    height: 100%;
    z-index: 2;
    opacity: 0;
    cursor: pointer;
}

.radio-box [type="radio"] {
    position: absolute;
    left: 0;
    top: 0;
    min-width: 16px;
    width: 100%;
    height: 100%;
    z-index: 2;
    opacity: 0;
    cursor: pointer;
}

.check-box {
    position: relative;
    display: inline-block;
    white-space: nowrap;
    line-height: 1;
}

.check-box__label {
    position: initial;
    display: inline-block;
    font-weight: 600;
    font-size: 13px;
    color: #333333;
    margin-left: 24px;
    white-space: normal;
}

.check-box__label:before,
.check-box__label:after {
    content: '';
    width: 18px;
    height: 18px;
    display: block;
    border: 2px solid transparent;
    z-index: 0;
    transition: all .5s ease;
    position: absolute;
    left: 0;
    top: 0;
}

.check-box__label:before {
    background-color: #f1f1f1;
}

.check-box__label:after {
    -webkit-transform: scale(0.6);
    transform: scale(0.6);
}

.check-box input:checked~.check-box__state label:before {
    -webkit-animation: mypulse 1s;
    animation: mypulse 1s;
}

.check-box input:checked~.check-box__state.check-box__state--primary label:before {
    border-color: #1275C6;
    background-color: #ffffff;
}

.check-box input:checked~.check-box__state.check-box__state--primary label:after {
    -webkit-transform: scale(0.4);
    transform: scale(0.4);
    background-color: #1275C6;
}

.radio-box {
    position: relative;
    display: inline-block;
    white-space: nowrap;
    line-height: 1;
}

.radio-box__label {
    position: initial;
    display: inline-block;
    font-weight: 600;
    font-size: 13px;
    color: #333333;
    white-space: normal;
    margin-left: 24px;
}

.radio-box__label:before,
.radio-box__label:after {
    content: '';
    width: 18px;
    height: 18px;
    display: block;
    border-radius: 50%;
    border: 2px solid transparent;
    z-index: 0;
    transition: all .5s ease;
    position: absolute;
    left: 0;
    top: 0;
}

.radio-box__label:before {
    background-color: #f1f1f1;
}

.radio-box__label:after {
    -webkit-transform: scale(0.6);
    transform: scale(0.6);
}

.radio-box input:checked~.radio-box__state label:before {
    -webkit-animation: mypulse 1s;
    animation: mypulse 1s;
}

.radio-box input:checked~.radio-box__state.radio-box__state--primary label:before {
    border-color: #1275C6;
    background-color: #ffffff;
}

.radio-box input:checked~.radio-box__state.radio-box__state--primary label:after {
    -webkit-transform: scale(0.4);
    transform: scale(0.4);
    background-color: #1275C6;
}


/* Select-Box Component */

.select-box {
    display: block;
    max-width: 100%;
    font-size: 13px;
    font-weight: 600;
    padding: 10px 12px 11px 15px;
    cursor: pointer;
    line-height: 1.2;
}

.select-box--primary-style {
    color: #333333;
    border: 2px solid transparent;
    background-color: #f1f1f1;
}

.select-box--transparent-b-2 {
    color: #333333;
    border: 1px solid transparent;
    background-color: transparent;
}

.select-box:focus {
    outline: 0;
}

.select-box::-ms-expand {
    background-color: transparent;
    border: 0;
}

.select-box:disabled {
    background-color: #cecece;
}

.select-box--primary-style:focus::-ms-value {
    color: #333333;
    background-color: #f1f1f1;
}

.select-box--transparent-b-2:focus::-ms-value {
    color: #333333;
    background-color: #ffffff;
}


/* Textarea Component */

.text-area {
    height: 100%;
    font-size: 12px;
    font-weight: 600;
    padding: 18px;
    resize: vertical;
}

.text-area--border-radius {
    border-radius: 25px;
}

.text-area--primary-style {
    color: #5c636c;
    transition: all 0.6s linear;
    border: 2px solid transparent;
    background-color: #f1f1f1;
}

.text-area--primary-style:focus {
    background-color: transparent;
    border-color: #1275C6;
}

.text-area:focus {
    outline: 0;
}


/* Modal Component */

.dismiss-button {
    z-index: 2;
    position: absolute;
    top: 0;
    right: -50px;
    background-color: transparent;
    padding: 8px;
    font-size: 24px;
    border: 0;
    color: #ffffff;
    cursor: pointer;
    transition: color 110ms ease-in-out;
}

.dismiss-button:hover {
    color: #1275C6;
}

#dash-newsletter .modal-dialog {
    width: 100%;
    max-width: 450px;
}

#dash-newsletter .modal-body {
    padding: 1.875rem;
}

.d-modal__form {
    width: 100%;
}

.d-modal__form .btn {
    padding: 14px 46px;
    font-size: 12px;
    font-weight: 600;
}

.d-modal__form a {
    font-size: 15px;
    font-weight: 600;
    color: #1275C6;
    transition: color 110ms ease-in-out;
}

.d-modal__form a:hover {
    color: #7f7f7f;
}

#edit-ship-address .modal-dialog,
#add-ship-address .modal-dialog {
    width: 100%;
    max-width: 750px;
}

#edit-ship-address .modal-body,
#add-ship-address .modal-body {
    padding: 1.875rem;
}

.checkout-modal1__form,
.checkout-modal2__form {
    width: 100%;
}

.checkout-modal1__form .btn,
.checkout-modal1__form .input-text,
.checkout-modal1__form .select-box,
.checkout-modal2__form .btn,
.checkout-modal2__form .input-text,
.checkout-modal2__form .select-box {
    border-radius: 6px;
}

.checkout-modal1__form .input-text,
.checkout-modal1__form .select-box,
.checkout-modal2__form .input-text,
.checkout-modal2__form .select-box {
    width: 100%;
}

.checkout-modal1__form .btn,
.checkout-modal2__form .btn {
    font-weight: 600;
    padding: 16px 46px;
}

#add-to-cart .modal-dialog {
    width: 100%;
    max-width: 550px;
}

#add-to-cart .row {
    -ms-flex-align: center;
    align-items: center;
}

.success {
    text-align: center;
}

.success__text-wrap {
    margin-bottom: 18px;
}

.success__text-wrap i {
    margin-right: 8px;
    font-size: 16px;
    color: #1275C6;
}

.success__text-wrap span {
    font-weight: 700;
    font-size: 14px;
    color: #333333;
}

.success__img-wrap {
    display: inline-block;
    vertical-align: middle;
    background-color: #f5f5f5;
    width: 120px;
    height: 120px;
}

.success__img-wrap img {
    min-width: 120px;
}

.success__name {
    display: block;
    margin: 4px 0;
    font-size: 14px;
    font-weight: 600;
    color: #333333;
}

.success__quantity {
    margin-bottom: 4px;
    display: block;
    font-size: 12px;
    color: #a0a0a0;
}

.success__price {
    display: block;
    font-weight: 700;
    font-size: 14px;
    color: #1275C6;
}

.s-option {
    text-align: center;
}

.s-option__text {
    display: block;
    margin-bottom: 20px;
    font-size: 12px;
    color: #a0a0a0;
}

.s-option__link-box {
    width: 85%;
    margin: 0 auto;
}

.s-option__link {
    margin-bottom: 20px;
    display: block;
    padding: 12px 8px;
    width: 100%;
    text-align: center;
    font-weight: 600;
    font-size: 13px;
}

#quick-look .modal-dialog {
    width: 100%;
    max-width: 991px;
}

#quick-look .modal-body {
    padding: 1.875rem;
}

.new-l--center {
    text-align: center;
}

#newsletter-modal .modal-dialog {
    width: 100%;
    max-width: 800px;
}

#newsletter-modal .modal-body {
    padding: 0;
}

#newsletter-modal .new-l__dismiss {
    z-index: 2;
    position: absolute;
    top: 0;
    right: 10px;
    background-color: transparent;
    padding: 8px;
    font-size: 16px;
    border: 0;
    color: #515151;
    cursor: pointer;
}

#newsletter-modal .row {
    -ms-flex-align: center;
    align-items: center;
}

.new-l__img-wrap {
    background-color: #f5f5f5;
    position: relative;
}

.new-l__img-wrap:before {
    transition: all 0.6s linear;
    content: '';
    position: absolute;
    z-index: 1;
    left: 0;
    right: 0;
    bottom: 0;
    top: 0;
    opacity: 0;
    background-color: rgba(0, 0, 0, 0.4);
}

.new-l__img-wrap:hover:before {
    opacity: 1;
}

.new-l__h3 {
    font-size: 26px;
    line-height: 1.2;
    color: #333333;
}

.new-l__p1 {
    font-size: 14px;
    line-height: 21px;
}

.new-l__p2 {
    font-size: 12px;
    color: #a0a0a0;
}

.new-l__link {
    font-size: 13px;
    color: #7f7f7f;
    transition: all .3s;
}

.new-l__link:hover {
    color: #1275C6;
    text-decoration: underline;
}

.new-l__form {
    width: 100%;
}

.new-l__form .btn {
    width: 100%;
}

.new-l__form .btn {
    padding: 13px 30px;
    font-size: 14px;
    font-weight: 600;
}

.news-l__input {
    width: 100%;
    font-size: 12px;
    padding: 0 18px;
    height: 40px;
    color: #333333;
    transition: all 0.6s linear;
    border: 2px solid rgba(0, 0, 0, 0.08);
    border-radius: 4px;
    background-color: #ffffff;
}

.news-l__input:focus {
    border-color: #1275C6;
}

.news-l__input:focus {
    outline: 0;
}

.news-l__input::-ms-clear {
    display: none;
}

@media (max-width: 991px) {
    .new-l__col-1 {
        display: none;
    }
}


/*--------------------------------------------------------------
6.0 Header
--------------------------------------------------------------*/

.header-wrapper {
    position: relative;
}

.header--style-1 {
    background-color: #ffffff;
}

.header--style-2 {
    background-color: #242424;
}

.header--style-3 {
    position: absolute;
    width: 100%;
    background-color: transparent;
    z-index: 2;
}

.header--box-shadow {
    box-shadow: 0 2px 7px 0 rgba(0, 0, 0, 0.07);
}


/* 6.1 Primary Nav */

.primary-nav-wrapper--border {
    border-bottom: 1px solid #f8f8f8;
}

.primary-nav {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    position: relative;
    height: 80px;
    width: 100%;
    -ms-flex-pack: justify;
    justify-content: space-between;
    -ms-flex-align: center;
    align-items: center;
}

.main-logo {
    display: inline-block;
    vertical-align: top;
}

.main-logo img {
    display: block;
}

.main-form {
    position: relative;
    width: 35%;
}

#main-search {
    padding: 0 36px 0 18px;
    width: 100%;
}

.main-search-button {
    position: absolute;
    top: 50%;
    right: 15px;
    -webkit-transform: translateY(-50%);
    transform: translateY(-50%);
    font-size: 18px;
}


/* 6.2 Secondary Nav */

.secondary-nav {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    position: relative;
    height: 80px;
    width: 100%;
    -ms-flex-pack: justify;
    justify-content: space-between;
    -ms-flex-align: center;
    align-items: center;
}

.has-superscript {
    position: relative;
}

.has-superscript:before {
    display: block;
    position: absolute;
    top: 10px;
    left: 40px;
    font-size: 10px;
    padding: 1px 7px;
    color: #ffffff;
}

.has-superscript--discount20:before {
    content: '-20% OFF';
}

.has-superscript--new:before {
    content: 'NEW';
}

.has-superscript--hot:before {
    content: 'HOT';
}

.has-superscript--sale:before {
    content: 'SALE';
}

.has-superscript--purple:before {
    background-color: #8d54ec;
}

.has-superscript--orange:before {
    background-color: #1275C6;
}

.has-superscript--mud:before {
    background-color: #878a85;
}

.has-superscript--ruby:before {
    background-color: #ee1a3d;
}

@media (max-width: 991px) {
    .header--style-3 {
        position: relative;
        background-color: #242424;
    }
}


/*--------------------------------------------------------------
7.0 Footer
--------------------------------------------------------------*/


/* 7.1 Outer-Footer */

.outer-footer {
    padding: 80px 0;
    background-color: #000000;
}

.outer-footer__content-title {
    display: block;
    color: #ffffff;
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 10px;
}

.outer-footer__logo-wrap {
    margin-bottom: 4px;
}

.outer-footer__text-wrap {
    margin-bottom: 6px;
}

.outer-footer__text-wrap>i {
    margin-right: 6px;
    font-size: 14px;
    color: #ffffff;
}

.outer-footer__text-wrap span {
    font-size: 14px;
    color: #ffffff;
}

.outer-footer__social ul {
    margin: 0;
    padding: 0;
    list-style: none;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
}

.outer-footer__social ul>li {
    margin-right: 16px;
}

.outer-footer__social ul>li>a {
    font-size: 14px;
    color: #ffffff;
    transition: color 0.6s;
}

.outer-footer__social ul>li:last-child {
    margin-right: 0;
}

.outer-footer__list-wrap ul {
    margin: 0;
    padding: 0;
    list-style: none;
}

.outer-footer__list-wrap ul>li {
    margin-bottom: 8px;
}

.outer-footer__list-wrap ul>li>a {
    transition: color 0.6s;
    color: #ffffff;
    font-size: 14px;
}

.outer-footer__list-wrap ul>li>a:hover {
    color: #1275C6;
}

.outer-footer__list-wrap ul>li:last-child {
    margin-bottom: 0;
}

.newsletter__group {
    position: relative;
}

.newsletter__btn {
    position: absolute;
    padding: 12px;
    right: 0;
    font-weight: 600;
    font-size: 12px;
    top: 50%;
    border: none;
    -webkit-transform: translateY(-50%);
    transform: translateY(-50%);
}

.newsletter__text {
    margin-top: 10px;
    display: block;
    color: #ffffff;
    font-size: 14px;
}

.newsletter__radio {
    margin-right: 20px;
}

.newsletter__radio .radio-box__label {
    color: #ffffff;
}

.newsletter__radio:last-child {
    margin-right: 0;
}

#newsletter {
    width: 100%;
    padding: 0 100px 0 18px;
}


/* 7.3 Lower-Footer */

.lower-footer {
    background-color: #000000;
    padding: 20px 0;
}

.lower-footer__content {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    -ms-flex-pack: justify;
    justify-content: space-between;
    -ms-flex-align: center;
    align-items: center;
}

.lower-footer__copyright,
.lower-footer__payment {
    -ms-flex: 0 1 auto;
}

.lower-footer__copyright span {
    font-size: 13px;
    color: #ffffff;
}

.lower-footer__copyright a {
    margin: 0 1px;
    font-size: 13px;
    color: #1275C6;
    transition: color 0.6s;
}

.lower-footer__copyright a:hover {
    color: #1275C6;
}

.lower-footer__img img {
    display: block;
}

.lower-footer__payment ul {
    margin: 0;
    padding: 0;
    list-style: none;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
}

.lower-footer__payment ul>li {
    margin-right: 16px;
}

.lower-footer__payment ul>li>i {
    font-size: 25px;
    color: #ffffff;
}

.lower-footer__payment ul>li:last-child {
    margin-right: 0;
}

@media (max-width: 767px) {
    .lower-footer__content {
        -ms-flex-pack: center;
        justify-content: center;
    }
    .lower-footer__copyright {
        margin-bottom: 8px;
    }
}


/*--------------------------------------------------------------
8.0 Index-Pages:
--------------------------------------------------------------*/

.fixed-list {
    position: fixed;
    top: 50%;
    right: 10px;
    z-index: 99;
    -webkit-transform: translateY(-50%);
    transform: translateY(-50%);
}

.fixed-list>ul {
    display: block;
    margin: 0;
    padding: 0;
    background-color: #ffffff;
    border-radius: 1.5625rem;
}

.fixed-list>ul>li>a {
    color: #333333;
    text-align: center;
    font-size: 14px;
    padding: 14px;
}

.fixed-list>ul>li>a.active {
    background-color: #1275C6;
    color: #ffffff;
}

.fixed-list>ul>li:first-child>a {
    border-top-left-radius: 1.5625rem;
    border-top-right-radius: 1.5625rem;
}

.fixed-list>ul>li:last-child>a {
    border-bottom-left-radius: 1.5625rem;
    border-bottom-right-radius: 1.5625rem;
}

.bg-anti-flash-white {
    background-color: #f3f3f3;
}

.white-container {
    width: 1220px;
    background-color: #ffffff;
    max-width: 100%;
    margin: 0 auto;
}

.section__intro {
    position: relative;
}

.block {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-pack: justify;
    justify-content: space-between;
    padding: 4px 0;
    -ms-flex-align: center;
    align-items: center;
    border-bottom: 1px solid #e7e7e7;
}

.block__title {
    color: #333333;
    display: block;
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 8px;
}

.category-o {
    position: relative;
    border: 2px dashed #f5f5f5;
    border-radius: 50%;
    overflow: hidden;
}

.category-o__img-wrap {
    border-radius: 50%;
}

.category-o__img {
    border-radius: 50%;
    -webkit-transform: scale(1);
    transform: scale(1);
    transition: all 0.6s linear;
}

.category-o__info {
    content: '';
    position: absolute;
    z-index: 2;
    width: 100%;
    text-align: center;
    bottom: 40px;
}

.category-o__shop-now {
    box-shadow: 0 3px 7px 0 rgba(0, 0, 0, 0.07);
    font-size: 13px;
    padding: 10px 25px;
    border-radius: 20px;
    font-weight: 600;
    display: inline-block;
}

.category-o:before {
    content: '';
    position: absolute;
    z-index: 1;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    transition: all 0.3s linear;
    background-color: rgba(0, 0, 0, 0.8);
    opacity: 0;
}

.category-o:hover:before {
    opacity: 1;
}

.category-o:hover .category-o__img {
    -webkit-transform: scale(1.1);
    transform: scale(1.1);
}

.tab-list {
    margin: 0;
    padding: 0;
}

.tab-list>li {
    margin-right: 8px;
    margin-bottom: 12px;
}

.tab-list>li>a {
    border-radius: 20px;
    font-weight: 600;
    font-size: 13px;
    padding: 10px 16px;
    color: #333333;
}

.tab-list>li>a.active {
    border-color: #1275C6;
    background-color: #1275C6;
    color: #ffffff;
}

.tab-list>li:last-child {
    margin-right: 0;
}

.promotion-o {
    position: relative;
    display: block;
    transition: -webkit-transform 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    transition: transform 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    transition: transform 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55), -webkit-transform 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}

.promotion-o__content {
    position: absolute;
    width: 100%;
    z-index: 2;
    -webkit-transform: translateY(-50%);
    transform: translateY(-50%);
    top: 50%;
    text-align: center;
}

.promotion-o__link {
    box-shadow: 0 3px 7px 0 rgba(0, 0, 0, 0.07);
    font-size: 13px;
    padding: 10px 25px;
    font-weight: 600;
    transition: all .3s linear;
    display: inline-block;
}

.promotion-o:hover {
    -webkit-transform: translateY(-6px);
    transform: translateY(-6px);
}

.i3-banner {
    position: relative;
    display: block;
    overflow: hidden;
    cursor: pointer;
}

.i3-banner:before {
    transition: all 0.6s linear;
    content: '';
    position: absolute;
    z-index: 1;
    left: 0;
    right: 0;
    bottom: 0;
    top: 0;
    opacity: 0;
    background-color: rgba(0, 0, 0, 0.4);
}

.i3-banner__img {
    -webkit-transform: scale(1);
    transform: scale(1);
    transition: all 0.6s ease-in-out;
}

.i3-banner:hover:before {
    opacity: 1;
}

.i3-banner:hover .i3-banner__img {
    -webkit-transform: scale(1.1);
    transform: scale(1.1);
}

.aspect--1048-334 {
    padding-bottom: 31.87023%;
}

.section__text-wrap {
    padding-left: 20px;
}

.section__content {
    position: relative;
}

.section__heading {
    font-weight: 600;
    letter-spacing: -.02rem;
    font-size: 28px;
    position: relative;
}

.section__span {
    font-size: 13px;
    display: block;
}

.collection {
    position: relative;
    display: block;
    overflow: hidden;
    cursor: pointer;
}

.collection:before {
    transition: all 0.6s linear;
    content: '';
    position: absolute;
    z-index: 1;
    left: 0;
    right: 0;
    bottom: 0;
    top: 0;
    opacity: 0;
    background-color: rgba(0, 0, 0, 0.4);
}

.collection__img {
    -webkit-transform: scale(1);
    transform: scale(1);
    transition: all 0.6s ease-in-out;
}

.collection:hover:before {
    opacity: 1;
}

.collection:hover .collection__img {
    -webkit-transform: scale(1.1);
    transform: scale(1.1);
}

.aspect--1286-890 {
    padding-bottom: 69.20684%;
}

.filter-category-container {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    -ms-flex-pack: center;
    justify-content: center;
}

.filter__btn--style-1 {
    position: relative;
    transition: all 0.3s ease 0s;
    display: block;
    border: none;
    padding: 18px;
    font-size: 14px;
    color: #333333;
    font-weight: 600;
    background-color: transparent;
}

.filter__btn--style-1:before {
    content: '';
    width: 0;
    height: 2px;
    background-color: #1275C6;
    position: absolute;
    top: 0;
    left: 50%;
    -webkit-transform: translateX(-50%);
    transform: translateX(-50%);
    transition: all 0.2s ease 0s;
}

.filter__btn--style-1:hover {
    color: #1275C6;
}

.filter__btn--style-1:hover:before {
    width: 100%;
}

.filter__btn--style-1.js-checked {
    color: #1275C6;
}

.filter__btn--style-1.js-checked:before {
    width: 100%;
}

.filter__btn--style-2 {
    transition: all 0.3s ease 0s;
    display: block;
    padding: 15px 27px;
    margin: 0 8px 10px;
    border: 2px solid #f7f7f9;
    font-size: 12px;
    color: #7f7f7f;
    background-color: transparent;
}

.filter__btn--style-2:hover {
    border-color: #1275C6;
    color: #333333;
}

.filter__btn--style-2.js-checked {
    border-color: #1275C6;
    color: #333333;
}

.section__text-wrap .view-text {
    text-align: right;
    padding-right: 30px;
}

.section__text-wrap .view-text a {
    padding: 8px 14px;
    font-size: 14px;
    color: #ff2d2d;
    font-weight: 600;
    transition: all linear .1s;
}

.section__text-wrap .view-text a:hover {
    background: #1275C6;
    color: #ffff;
    padding: 10px 20px;
    border-radius: 10px;
    font-weight: 600;
}

.load-more {
    text-align: center;
    padding: 20px 0;
}

.load-more>button {
    padding: 12px 29px;
    border: none;
    border-radius: 5px;
    font-size: 15px;
}

.banner-bg {
    padding: 7em 0;
    position: relative;
    background: #f5f5f5 url(../images/banners/banner-bg4.jpg) repeat fixed center center;
    background-size: cover;
}

.banner-bg__wrap {
    text-align: center;
}

.banner-bg__text-block {
    display: block;
}

.banner-bg__text-1 {
    font-weight: 600;
    margin-bottom: 6px;
    font-size: 58px;
}

.banner-bg__text-2 {
    font-weight: 600;
    margin-bottom: 12px;
    font-size: 31px;
}

.banner-bg__text-3 {
    margin-bottom: 18px;
    font-size: 14px;
}

.banner-bg__shop-now {
    display: inline-block;
    padding: 14px 30px;
    font-weight: 600;
    border-radius: 40px;
    font-size: 13px;
}

.promotion {
    display: block;
    position: relative;
}

.promotion:before {
    transition: all 0.3s linear;
    content: '';
    position: absolute;
    z-index: 1;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.6);
    opacity: 0;
}

.promotion__content {
    position: absolute;
    width: 100%;
    z-index: 2;
    -webkit-transform: translateY(-50%);
    transform: translateY(-50%);
    top: 50%;
    text-align: center;
}

.promotion__text-wrap {
    display: inline-block;
    background-color: rgba(255, 255, 255, 0.9);
    padding: 30px 15px;
    transition: all 0.5s ease-in-out;
}

.promotion__text-1 {
    font-size: 14px;
}

.promotion__text-2 {
    font-size: 20px;
    font-weight: 600;
}

.promotion:hover:before {
    opacity: 1;
}

.promotion:hover .promotion__text-wrap {
    background-color: white;
}

.column-product__title {
    display: block;
    font-size: 18px;
    font-weight: 600;
}

.column-product__list {
    margin: 0;
    padding: 0;
    list-style: none;
}

.column-product__item {
    margin-bottom: 30px;
}

.column-product__item:last-child {
    margin-bottom: 0;
}

.service {
    display: -ms-flexbox;
    display: flex;
    background-color: #ffffff;
    padding: 23px;
    box-shadow: 0 6px 15px 0 rgba(36, 37, 38, 0.08);
    border: 2px solid #f5f5f5;
}

.service__icon,
.service__info-wrap {
    -ms-flex: 0 1 auto;
}

.service__icon {
    margin-right: 20px;
}

.service__icon>i {
    color: #1275C6;
    font-size: 30px;
}

.service__info-text-1 {
    display: block;
    font-size: 14px;
    margin-bottom: 4px;
    color: #333333;
    font-weight: 600;
}

.service__info-text-2 {
    font-size: 13px;
    display: block;
    color: #7f7f7f;
}

.new-brand-slider {
    position: relative;
}

#brand-slider {
    position: static;
}

@media (max-width: 991px) {
    .block {
        display: block;
    }
    .success__img-wrap,
    .success__info-wrap {
        display: none;
    }
}


/*--------------------------------------------------------------
9.0 About-Page
--------------------------------------------------------------*/

.about {
    background-color: #ffffff;
    box-shadow: 0 1px 15px 0 rgba(0, 0, 0, 0.07);
}

.about__container {
    padding: 60px;
}

.about__info {
    text-align: center;
}

.about__h2 {
    color: #333333;
    font-weight: 600;
    margin-bottom: 10px;
    font-size: 24px;
}

.about .about__p-wrap {
    position: relative;
    margin-bottom: 20px;
}

.about .about__p-wrap:before,
.about .about__p-wrap:after {
    content: '';
    display: block;
    width: 70px;
    position: absolute;
    border: solid #1275C6;
}

.about .about__p-wrap:before {
    top: -10px;
    left: -8px;
    border-top-width: 1px;
}

.about .about__p-wrap:after {
    bottom: -10px;
    right: -8px;
    border-bottom-width: 1px;
}

.about__p {
    color: #333333;
}

.about__link {
    display: inline-block;
    padding: 12px 42px;
    border-radius: 40px;
    font-weight: 600;
    font-size: 12px;
}

.team-member {
    background-color: #fbfbfb;
    transition: -webkit-transform 0.7s ease-in-out;
    transition: transform 0.7s ease-in-out;
    transition: transform 0.7s ease-in-out, -webkit-transform 0.7s ease-in-out;
}

.team-member__wrap {
    position: relative;
}

.team-member__social-wrap {
    width: 100%;
    position: absolute;
    top: 50%;
    left: 0;
    opacity: 0;
    z-index: 2;
    -webkit-transform: translateY(-50%) scale(0.8);
    transform: translateY(-50%) scale(0.8);
    transition: all 0.2s ease 0s;
}

.team-member__social-list {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-pack: center;
    justify-content: center;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin: 0;
    padding: 0;
    list-style: none;
}

.team-member__social-list>li {
    margin: 0 4px 6px;
    opacity: 0;
    -webkit-transform: translateY(50%);
    transform: translateY(50%);
    transition: all 0.3s ease 0.1s;
}

.team-member__social-list>li>a {
    display: block;
    width: 35px;
    text-align: center;
    border-radius: 50%;
    height: 35px;
    line-height: 35px;
    background-color: #ffffff;
    color: #1275C6;
    font-size: 12px;
    transition: all 0.3s ease 0s;
}

.team-member__social-list>li>a:hover {
    color: #ffffff;
}

.team-member__info {
    padding: 16px;
}

.team-member__name {
    display: block;
    font-size: 14px;
    font-weight: 600;
    color: #333333;
}

.team-member__job-title {
    display: block;
    font-size: 11px;
    color: #a0a0a0;
}

.team-member:hover {
    -webkit-transform: translateY(-8px);
    transform: translateY(-8px);
}

.team-member:hover .team-member__social-wrap {
    opacity: 1;
    -webkit-transform: translateY(-50%) scale(1);
    transform: translateY(-50%) scale(1);
}

.team-member:hover .team-member__social-list>li {
    opacity: 1;
    -webkit-transform: translateY(0);
    transform: translateY(0);
}

.testimonial {
    text-align: center;
}

.testimonial__img-wrap {
    margin-bottom: 16px;
}

.testimonial__double-quote {
    display: block;
}

.testimonial__double-quote i {
    font-size: 28px;
    color: #333333;
}

.testimonial__block-quote {
    margin: 0 auto;
    width: 70%;
    padding: 10px 20px;
}

.testimonial__block-quote p {
    font-size: 14px;
    font-weight: 600;
    color: #333333;
}

.testimonial__author {
    display: block;
    font-size: 13px;
    color: #a0a0a0;
}

.testimonial .testimonial__img-wrap .testimonial__img {
    display: inline-block;
    width: 165px;
    height: 165px;
    border-radius: 50%;
}


/*--------------------------------------------------------------
10.0 Contact-Page
--------------------------------------------------------------*/

.g-map {
    background-color: #eee;
}

#map {
    height: 450px;
    width: 100%;
}

.contact-o {
    background-color: #ffffff;
    padding: 23px;
    transition: -webkit-transform 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    transition: transform 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    transition: transform 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55), -webkit-transform 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    border: 2px solid #f5f5f5;
    box-shadow: 0 6px 15px 0 rgba(36, 37, 38, 0.08);
}

.contact-o:hover {
    -webkit-transform: translateY(-6px);
    transform: translateY(-6px);
}

.contact-o__wrap {
    text-align: center;
}

.contact-o__icon {
    margin-bottom: 10px;
}

.contact-o__icon>i {
    color: #1275C6;
    font-size: 48px;
}

.contact-o__info-text-1 {
    display: block;
    font-size: 17px;
    margin-bottom: 4px;
    color: #333333;
    font-weight: 600;
    text-transform: uppercase;
}

.contact-o__info-text-2 {
    font-size: 12px;
    margin-bottom: 2px;
    display: block;
    color: #7f7f7f;
}

.contact-area__heading {
    margin-bottom: 30px;
}

.contact-area__heading h2 {
    display: inline-block;
    font-size: 26px;
    font-weight: 700;
    color: #333333;
    background-color: #ffffff;
}

.contact-f {
    width: 100%;
}

.contact-f .input-text,
.contact-f .text-area {
    border-radius: 6px;
    width: 100%;
}

.contact-f .text-area {
    height: 185px;
}

.contact-f .btn {
    padding: 19px 21px;
    border-radius: 25px;
}


/*--------------------------------------------------------------
11.0 Cart-Wishlist-Pages
--------------------------------------------------------------*/

.table-responsive {
    overflow-x: auto;
}

.table-p {
    width: 100%;
    border: 1px solid #eee;
    border-collapse: collapse;
}

.table-p tr {
    position: relative;
    border-top: 1px solid #eee;
}

.table-p td {
    padding: 20px;
}

.table-p__box {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: nowrap;
    flex-wrap: nowrap;
    -ms-flex-align: center;
    align-items: center;
}

.table-p__img-wrap {
    display: inline-block;
    vertical-align: middle;
    background-color: #f5f5f5;
    width: 120px;
    height: 120px;
}

.table-p__img-wrap img {
    display: block;
    min-width: 120px;
}

.table-p__info {
    margin-left: 18px;
}

.table-p__name {
    display: block;
}

.table-p__name>a {
    color: #333333;
    font-size: 14px;
    font-weight: 600;
    transition: color 0.5s;
}

.table-p__name>a:hover {
    color: #1275C6;
}

.table-p__category {
    display: block;
}

.table-p__category>a {
    color: #a0a0a0;
    transition: color 0.5s;
    font-size: 12px;
}

.table-p__category>a:hover {
    color: #1275C6;
}

.table-p__variant-list {
    margin: 0;
    padding: 0;
    list-style: none;
}

.table-p__variant-list>li>span {
    color: #a0a0a0;
    font-size: 12px;
}

.table-p__price {
    text-align: center;
    display: block;
    color: #333333;
    font-size: 14px;
    font-weight: 600;
}

.table-p__input-counter-wrap {
    text-align: center;
}

.table-p__del-wrap {
    text-align: center;
}

.table-p__delete-link {
    padding: 10px;
    font-size: 16px;
    display: inline-block;
    color: #333333;
    transition: color 0.5s;
}

.table-p__delete-link:hover {
    color: #1275C6;
}

.w-r {
    background-color: #ffffff;
    border: 1px solid #eee;
    box-shadow: 1px 1px 6px 0 rgba(0, 0, 0, 0.07);
}

.w-r__container {
    display: -ms-flexbox;
    display: flex;
    padding: 20px;
    -ms-flex-wrap: nowrap;
    flex-wrap: nowrap;
    -ms-flex-align: center;
    align-items: center;
    -ms-flex-pack: justify;
    justify-content: space-between;
}

.w-r__wrap-1,
.w-r__wrap-2 {
    -ms-flex: 0 1 auto;
}

.w-r__wrap-1 {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: nowrap;
    flex-wrap: nowrap;
    -ms-flex-align: center;
    align-items: center;
    -ms-flex-pack: start;
    justify-content: flex-start;
}

.w-r__img-wrap {
    display: inline-block;
    vertical-align: middle;
    background-color: #f5f5f5;
    width: 120px;
    height: 120px;
}

.w-r__img-wrap img {
    display: block;
    min-width: 120px;
}

.w-r__info {
    margin-left: 18px;
}

.w-r__name {
    display: block;
}

.w-r__name>a {
    color: #333333;
    font-size: 14px;
    font-weight: 600;
    transition: color 0.5s;
}

.w-r__name>a:hover {
    color: #1275C6;
}

.w-r__category {
    display: block;
    margin-bottom: 2px;
}

.w-r__category>a {
    color: #a0a0a0;
    transition: color 0.5s;
    font-size: 12px;
}

.w-r__category>a:hover {
    color: #1275C6;
}

.w-r__price {
    display: block;
    color: #1275C6;
    font-size: 14px;
    font-weight: 600;
}

.w-r__discount {
    font-weight: 600;
    margin-left: 12px;
    color: #333333;
    font-size: 14px;
    text-decoration: line-through;
}

.w-r__link {
    font-size: 12px;
    font-weight: 600;
    display: inline-block;
    border-radius: 5px;
    margin: 0 0 10px 10px;
    padding: 12px 30px;
}

.route-box {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: center;
    align-items: center;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    background-color: #f1f1f1;
    -ms-flex-pack: justify;
    justify-content: space-between;
}

.route-box__g {
    -ms-flex: 0 1 auto;
}

.route-box__link {
    color: #333333;
    font-size: 13px;
    text-align: center;
    padding: 17px;
    font-weight: 600;
    display: inline-block;
    transition: color 0.5s;
}

.route-box__link:hover {
    color: #1275C6;
}

.route-box i {
    margin-right: 2px;
}

.f-cart__pad-box {
    border: 1px solid #eee;
    padding: 32px 22px 35px;
}

.f-cart__table {
    width: 100%;
    border-collapse: collapse;
}

.f-cart__table td {
    color: #333333;
    vertical-align: middle;
    font-size: 14px;
    font-weight: 600;
    padding: 8px 0;
}

.f-cart__table td:first-child {
    text-align: left;
}

.f-cart__table td {
    text-align: right;
}

.f-cart__table tr:last-child td {
    font-size: 16px;
    font-weight: 700;
    color: #1275C6;
}

.f-cart__ship-link {
    font-size: 13px;
    text-align: center;
    padding: 17px;
    font-weight: 600;
    border-radius: 6px;
    display: block;
}

.f-cart .input-text,
.f-cart .select-box,
.f-cart .text-area,
.f-cart .btn {
    border-radius: 6px;
    width: 100%;
}

.f-cart .text-area {
    height: 350px;
}

.f-cart .btn {
    padding: 16px;
    font-weight: 600;
    font-size: 13px;
}

@media (max-width: 991px) {
    .w-r__wrap-2 {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-direction: column;
        flex-direction: column;
        -ms-flex-wrap: nowrap;
        flex-wrap: nowrap;
        -ms-flex-align: end;
        align-items: flex-end;
    }
}

@media (max-width: 767px) {
    .table-p td {
        min-width: 200px;
    }
    .w-r__container {
        -ms-flex-direction: column;
        flex-direction: column;
    }
    .w-r__wrap-1 {
        -ms-flex-direction: column;
        flex-direction: column;
    }
    .w-r__info {
        text-align: center;
        margin: 15px 0 15px;
    }
    .w-r__wrap-2 {
        -ms-flex-align: center;
        align-items: center;
    }
}


/*--------------------------------------------------------------
12.0 Empty-404-Pages
--------------------------------------------------------------*/

.empty {
    text-align: center;
}

.empty__big-text {
    display: block;
    margin-bottom: 12px;
    color: #1275C6;
    line-height: 1;
    font-size: 85px;
    font-weight: 600;
}

.empty__text-1 {
    display: block;
    font-size: 14px;
    font-weight: 700;
    margin-bottom: 12px;
    color: #333333;
}

.empty__text-2 {
    display: block;
    font-size: 14px;
    font-weight: 700;
    margin-bottom: 24px;
    color: #a0a0a0;
}

.empty__text-2>a {
    color: #1275C6;
    padding: 2px;
}

.empty__text-2>a:after {
    content: ',';
    margin: 0 2px;
    color: #333333;
}

.empty__text-2>a:last-child:after {
    content: none;
}

.empty__search-form {
    position: relative;
    width: 40%;
    margin: 0 auto;
}

.empty__search-form .btn {
    position: absolute;
    top: 50%;
    -webkit-transform: translateY(-50%);
    transform: translateY(-50%);
    right: 8px;
}

.empty__redirect-link {
    border-radius: 40px;
    padding: 16px;
    display: inline-block;
    font-weight: 600;
    font-size: 13px;
}

#search-label {
    padding: 0 36px 0 18px;
    width: 100%;
}


/*--------------------------------------------------------------
13.0 Checkout-Page
--------------------------------------------------------------*/

.msg {
    background-color: #ffffff;
    box-shadow: 0 6px 15px 0 rgba(36, 37, 38, 0.08);
    padding: 20px;
}

.msg__text {
    padding: 8px 0;
    display: block;
    font-size: 14px;
    font-weight: 600;
    color: #333333;
}

.l-f__form {
    width: 100%;
}

.l-f .input-text {
    width: 100%;
}

.l-f .input-text,
.l-f .btn {
    border-radius: 6px;
}

.l-f .btn {
    font-weight: 600;
    padding: 12px 18px;
}

.c-f__form {
    position: relative;
    width: 50%;
}

.c-f .input-text {
    width: 100%;
}

.c-f .input-text,
.c-f .btn {
    border-radius: 6px;
}

.c-f .btn {
    font-weight: 600;
    padding: 12px 18px;
}

.checkout-f {
    width: 100%;
}

.checkout-f .input-text,
.checkout-f .select-box,
.checkout-f .text-area,
.checkout-f .btn {
    width: 100%;
    border-radius: 6px;
}

.checkout-f .text-area {
    height: 185px;
}

.checkout-f .btn {
    font-weight: 600;
    padding: 18px;
}

.checkout-f__h1 {
    color: #333333;
    font-size: 18px;
    margin-bottom: 8px;
}

.o-summary__section {
    background-color: #ffffff;
    border: 1px solid #eee;
}

.o-summary__box {
    padding: 20px;
}

.o-summary__item-wrap {
    max-height: 228px;
    padding: 17px;
    overflow-y: auto;
}

.o-summary__table {
    width: 100%;
    border-collapse: collapse;
}

.o-summary__table td {
    color: #333333;
    vertical-align: middle;
    font-size: 14px;
    font-weight: 600;
    padding: 8px 0;
}

.o-summary__table td:first-child {
    text-align: left;
}

.o-summary__table td {
    text-align: right;
}

.o-summary__table tr:last-child td {
    font-size: 16px;
    font-weight: 700;
    color: #1275C6;
}

.o-card {
    border: 1px solid #f5f5f5;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: nowrap;
    flex-wrap: nowrap;
    -ms-flex-align: center;
    align-items: center;
    -ms-flex-pack: justify;
    justify-content: space-between;
    background-color: #ffffff;
    padding: 10px;
    margin-bottom: 22px;
}

.o-card:last-child {
    margin-bottom: 0;
}

.o-card__flex {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: center;
    align-items: center;
}

.o-card__img-wrap {
    display: inline-block;
    vertical-align: middle;
    width: 60px;
    height: 60px;
    background-color: #f5f5f5;
}

.o-card__img-wrap img {
    display: block;
    min-width: 60px;
}

.o-card__info-wrap {
    margin-left: 18px;
}

.o-card__name {
    display: block;
}

.o-card__name>a {
    color: #333333;
    font-size: 13px;
    font-weight: 600;
    transition: color 0.5s;
}

.o-card__name>a:hover {
    color: #1275C6;
}

.o-card__quantity {
    font-size: 13px;
    margin-bottom: 2px;
    display: block;
}

.o-card__price {
    display: block;
    color: #1275C6;
    font-size: 13px;
    font-weight: 600;
}

.o-card__del {
    padding: 10px;
    font-size: 16px;
    display: inline-block;
    color: #333333;
    transition: color 0.5s;
}

.o-card__del:hover {
    color: #1275C6;
}

.ship-b__text {
    display: block;
    font-weight: 600;
    font-size: 13px;
    color: #333333;
    margin-bottom: 4px;
}

.ship-b__box {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: center;
    align-items: center;
    -ms-flex-pack: justify;
    justify-content: space-between;
}

.ship-b__p {
    margin-bottom: 4px;
    color: #7f7f7f;
    font-weight: 600;
    font-size: 13px;
    -ms-flex: 0 0 50%;
    flex: 0 0 50%;
    max-width: 50%;
}

.ship-b__edit {
    display: inline-block;
    font-size: 13px;
    font-weight: 600;
    padding: 6px 12px;
    border-radius: 6px;
}

@media (max-width: 575px) {
    .o-summary__item-wrap {
        max-height: 466px;
    }
    .o-card__flex {
        display: block;
        padding: 14px;
        text-align: center;
    }
    .o-card__info-wrap {
        margin-left: 0;
    }
    .ship-b__box {
        display: block;
    }
    .ship-b__p {
        max-width: 100%;
    }
}


/*--------------------------------------------------------------
14.0 Signin Signup Lost Password-Page
--------------------------------------------------------------*/

.l-f-o {
    border: 1px solid #eee;
}

.l-f-o__pad-box {
    padding: 20px;
}

.l-f-o__form {
    width: 100%;
}

.l-f-o .input-text,
.l-f-o .btn,
.l-f-o .select-box {
    border-radius: 6px;
}

.l-f-o .input-text {
    width: 100%;
}

.l-f-o .btn {
    font-weight: 600;
    padding: 12px 18px;
}

.l-f-o__create-link {
    font-size: 13px;
    text-align: center;
    padding: 12px;
    display: block;
    font-weight: 600;
    border-radius: 6px;
}


/*--------------------------------------------------------------
15.0 FAQ-Page
--------------------------------------------------------------*/

.faq__heading {
    font-weight: 700;
    font-size: 13px;
    color: #333333;
    margin-bottom: 6px;
}

.faq__text {
    font-size: 13px;
    color: #7f7f7f;
}

.faq__list {
    border-top: 1px solid #eee;
    padding: 14px 0;
}

.faq__list:last-child {
    border-bottom: 1px solid #eee;
}

.faq__question {
    display: block;
    position: relative;
    padding: 8px 0;
    font-size: 16px;
    font-weight: 600;
    color: #333333;
}

.faq__question:before {
    content: "\F107";
    font-family: 'Font Awesome 5 Free';
    font-weight: 900;
    position: absolute;
    top: 8px;
    -webkit-transform: rotate(180deg);
    transform: rotate(180deg);
    right: 12px;
    transition: -webkit-transform 0.5s ease-in-out;
    transition: transform 0.5s ease-in-out;
    transition: transform 0.5s ease-in-out, -webkit-transform 0.5s ease-in-out;
}

.faq__question.collapsed:before {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
}


/*--------------------------------------------------------------
16.0 Dashboard-Pages
--------------------------------------------------------------*/

.dash__box--bg-white {
    background-color: #ffffff;
}

.dash__box--border {
    border: 1px solid #eee;
}

.dash__box--bg-grey {
    background-color: #fbfbfb;
}

.dash__box--shadow {
    box-shadow: -2px 0px 14px 0 rgba(36, 37, 38, 0.08);
}

.dash__box--shadow-2 {
    box-shadow: -6px 2px 8px 0 rgba(36, 37, 38, 0.08);
}

.dash__box--radius {
    border-radius: 15px;
}

.dash__pad-1 {
    padding: 26px 20px;
}

.dash__pad-2 {
    padding: 24px;
}

.dash__pad-3 {
    padding: 26px;
}

.dash__f-list {
    margin: 0;
    padding: 0;
    list-style: none;
}

.dash__f-list>li {
    padding: 4px 0;
}

.dash__f-list>li>a {
    font-size: 13px;
    display: block;
    color: #000000;
}

.dash-l-r {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: center;
    align-items: center;
    -ms-flex-pack: justify;
    justify-content: space-between;
}

.dash-active {
    font-weight: 600;
    color: #000000;
}

.dash__w-list {
    margin: 0;
    padding: 0;
    list-style: none;
    text-align: center;
}

.dash__w-list>li {
    border-bottom: 1px solid #eee;
}

.dash__w-wrap {
    padding: 18px 0;
}

.dash__w-icon {
    width: 45px;
    height: 45px;
    display: inline-block;
    line-height: 45px;
    border-radius: 50%;
    font-size: 14px;
    margin-bottom: 8px;
}

.dash__w-icon-style-1 {
    background-color: rgba(255, 69, 0, 0.14);
}

.dash__w-icon-style-1>i {
    color: #1275C6;
}

.dash__w-icon-style-2 {
    background-color: rgba(0, 148, 68, 0.14);
}

.dash__w-icon-style-2>i {
    color: #009444;
}

.dash__w-icon-style-3 {
    background-color: rgba(49, 133, 252, 0.14);
}

.dash__w-icon-style-3>i {
    color: #3185FC;
}

.dash__w-text {
    display: block;
    font-weight: 700;
    font-size: 40px;
    line-height: 1;
    color: #000000;
}

.dash__w-name {
    display: block;
    color: #a0a0a0;
    font-weight: 600;
    font-size: 13px;
}

.dash__h1 {
    line-height: 1;
    color: #333333;
    font-size: 18px;
}

.dash__h2 {
    line-height: 1;
    font-size: 14px;
    color: #333333;
}

.dash__text {
    display: block;
    font-size: 12px;
    color: #7f7f7f;
}

.dash__text-2 {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: #7f7f7f;
}

.dash__link>a {
    font-size: 13px;
    font-weight: 600;
    transition: color 0.5s linear;
}

.dash__link--brand>a {
    color: #1275C6;
}

.dash__link--brand>a:hover {
    color: #1275C6;
}

.dash__link--secondary>a {
    color: #333333;
}

.dash__link--secondary>a:hover {
    color: #1275C6;
}

.dash__link--black>a {
    color: #000000;
}

.dash__table-wrap {
    height: 300px;
    overflow: auto;
}

.dash__table {
    width: 100%;
    border-collapse: collapse;
}

.dash__table thead {
    background-color: #fbfbfb;
}

.dash__table th,
.dash__table td {
    padding: 20px;
    text-align: center;
    font-weight: 600;
    color: #333333;
}

.dash__table th {
    font-size: 14px;
}

.dash__table td {
    font-size: 13px;
}

.dash__table tbody tr {
    border-bottom: 1px solid #eee;
}

.dash__table tbody tr:last-child {
    border-bottom: 0;
}

.dash__table-img-wrap {
    background-color: #f5f5f5;
    display: inline-block;
    vertical-align: middle;
    width: 40px;
    height: 40px;
}

.dash__table-img-wrap img {
    display: block;
    min-width: 40px;
}

.dash-edit-p {
    width: 100%;
}

.dash-edit-p .btn,
.dash-edit-p .input-text,
.dash-edit-p .select-box {
    border-radius: 6px;
}

.dash-edit-p .input-text {
    width: 100%;
}

.dash-edit-p .btn {
    font-weight: 600;
    padding: 16px 46px;
}

.dash__custom-link {
    font-weight: 600;
    display: inline-block;
    text-align: center;
    padding: 14px 18px;
    font-size: 13px;
    border-radius: 6px;
    width: 12rem;
}

.manage-o__text {
    font-size: 13px;
    font-weight: 600;
}

.manage-o__text-2 {
    font-size: 14px;
    font-weight: 600;
}

.manage-o__header {
    padding-bottom: 14px;
    border-bottom: 1px solid #eee;
}

.manage-o__icon {
    font-weight: 600;
    font-size: 13px;
    color: #333333;
}

.manage-o__timeline {
    padding-top: 40px;
}

.manage-o__timeline [class*="col-"] {
    padding: 0;
    text-align: center;
}

.timeline-row {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
}

.timeline-l-i {
    position: relative;
    border-radius: 3px;
    border-top: 3px solid #eee;
}

.timeline-l-i .timeline-circle {
    position: absolute;
    width: 18px;
    height: 18px;
    background: #ffffff;
    border: 2px solid #eee;
    margin: auto;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
}

.timeline-l-i .timeline-circle:before {
    content: "";
    display: block;
    width: 8px;
    height: 8px;
    background-color: #eee;
    margin: auto;
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
}

.timeline-l-i.timeline-l-i--finish {
    border-color: #6B5AED;
}

.timeline-l-i.timeline-l-i--finish .timeline-circle {
    border-color: #6B5AED;
}

.timeline-l-i.timeline-l-i--finish .timeline-circle:before {
    background-color: #6B5AED;
}

.timeline-text {
    margin-top: 20px;
    font-size: 13px;
    text-transform: uppercase;
    display: block;
    font-weight: 600;
    color: #333333;
}

.manage-o__description {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: center;
    align-items: center;
    -ms-flex-pack: justify;
    justify-content: space-between;
}

.description__container {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: center;
    align-items: center;
}

.description__img-wrap {
    width: 90px;
    height: 90px;
    border-radius: 50%;
    display: inline-block;
    vertical-align: middle;
    background: #f5f5f5;
}

.description__img-wrap img {
    border-radius: 50%;
    display: block;
    min-width: 90px;
}

.description-title {
    margin-left: 12px;
    font-size: 14px;
    font-weight: 600;
    color: #333333;
}

.dash__address-header {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: center;
    align-items: center;
    -ms-flex-pack: justify;
    justify-content: space-between;
}

.dash__table-2-wrap {
    overflow: auto;
}

.dash__table-2 {
    width: 100%;
    border-collapse: collapse;
}

.dash__table-2 thead {
    background-color: #fbfbfb;
}

.dash__table-2 th,
.dash__table-2 td {
    padding: 20px;
    min-width: 200px;
    text-align: left;
    font-weight: 600;
    color: #333333;
}

.dash__table-2 th {
    font-size: 14px;
}

.dash__table-2 td {
    font-size: 13px;
}

.dash__table-2 tbody tr {
    border-bottom: 1px solid #eee;
}

.dash__table-2 tbody tr:last-child {
    border-bottom: 0;
}

.address-book-edit {
    display: inline-block;
    font-size: 13px;
    font-weight: 600;
    padding: 6px 12px;
    border-radius: 6px;
}

.dash__address-make {
    width: 100%;
}

.dash__address-make .btn {
    font-weight: 600;
    padding: 16px 46px;
    border-radius: 6px;
}

.dash-address-manipulation {
    width: 100%;
}

.dash-address-manipulation .btn,
.dash-address-manipulation .input-text,
.dash-address-manipulation .select-box {
    border-radius: 6px;
}

.dash-address-manipulation .input-text,
.dash-address-manipulation .select-box {
    width: 100%;
}

.dash-address-manipulation .btn {
    font-weight: 600;
    padding: 16px 46px;
}

.dash-track-order {
    width: 100%;
}

.dash-track-order .btn,
.dash-track-order .input-text {
    border-radius: 6px;
}

.dash-track-order .input-text {
    width: 100%;
}

.dash-track-order .btn {
    font-weight: 600;
    padding: 16px 46px;
}

.m-order {
    width: 100%;
}

.m-order__select-wrapper {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: center;
    align-items: center;
}

.m-order label {
    color: #333333;
    font-size: 13px;
    font-weight: 600;
}

.m-order .select-box {
    border-radius: 6px;
}

.m-order__list {
    background-color: #ffffff;
}

.m-order__get {
    border: 1px solid #eee;
    margin-bottom: 30px;
    background-color: #ffffff;
    padding: 24px;
}

.m-order__get:last-child {
    margin-bottom: 0;
}

.manage-o__badge {
    display: inline-block;
    text-align: center;
    width: 5.9375rem;
    padding: 8px;
    font-size: 13px;
    font-weight: 600;
    background-color: transparent;
    border-radius: 32px;
}

.badge--processing {
    background-color: rgba(49, 133, 252, 0.14);
    color: #3185FC;
}

.badge--shipped {
    background-color: rgba(0, 148, 68, 0.14);
    color: #009444;
}

.badge--delivered {
    background-color: rgba(255, 69, 0, 0.14);
    color: #1275C6;
}

@media (max-width: 991px) {
    .dash__box--w {
        margin-bottom: 30px;
    }
}

@media (max-width: 767px) {
    .dash__address-header {
        display: block;
    }
    .dash__address-header .dash__h1 {
        margin-bottom: 8px;
    }
    .dash__address-header .dash__link {
        display: block;
    }
}

@media (max-width: 575px) {
    .dash-l-r {
        display: block;
    }
    .manage-o__description {
        display: block;
        text-align: center;
    }
    .description__container {
        display: block;
    }
    .description-title {
        margin: 12px 0;
    }
}


/*--------------------------------------------------------------
17.0 Blog-Pages
--------------------------------------------------------------*/

.blog-t-w {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
}

.post-prev,
.post-next {
    text-align: center;
    z-index: 1;
    cursor: pointer;
    display: inline-block;
    position: absolute;
    top: 0;
    bottom: 0;
    width: 35px;
    height: 35px;
    line-height: 35px;
    border-radius: 50%;
    color: #333333;
    background-color: #ffffff;
    box-shadow: 0 6px 15px 0 rgba(36, 37, 38, 0.08);
    margin: auto 0;
    opacity: 0;
    transition: opacity .6s ease-in;
}

.post-prev {
    left: 20px;
}

.post-next {
    right: 20px;
}

.post-prev:before,
.post-next:before {
    content: '';
    background: rgba(255, 255, 255, 0.3);
    width: 35px;
    height: 35px;
    position: absolute;
    left: 0;
    top: 0;
    transition: all .3s;
    border-radius: 50%;
    box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.4);
}

.post-prev:hover:before,
.post-next:hover:before {
    -webkit-transform: scale(1.6);
    transform: scale(1.6);
    opacity: .6;
}

.post-gallery:hover .post-prev,
.post-gallery:hover .post-next {
    opacity: 1;
}

.post-video-block {
    position: relative;
    background-color: #f5f5f5;
    width: 100%;
}

.post-video-link {
    position: absolute;
    width: 100%;
    height: 100%;
    z-index: 7;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    -ms-flex-pack: center;
    justify-content: center;
    -ms-flex-align: center;
    align-items: center;
}

.post-video-link:before {
    width: 3.875rem;
    height: 3.875rem;
    position: absolute;
    top: 50%;
    left: 50%;
    margin-top: -1.9375rem;
    margin-left: -1.9375rem;
    transition: -webkit-transform .3s;
    transition: transform .3s;
    transition: transform .3s, -webkit-transform .3s;
    border-radius: 50%;
    box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.4);
    z-index: 3;
}

.post-video-link:hover:before {
    box-shadow: 0 0 0 12px rgba(255, 255, 255, 0.3);
    -webkit-transform: scale(0.9);
    transform: scale(0.9);
}

.post-video-block .post-video-link:before {
    content: '';
    background: url(../video/video-play.png) no-repeat 0 0;
    background-size: contain;
}

.post-video-block.process .post-video-link:before {
    content: none;
}

.post-video-block.process.pause .post-video-link:before {
    content: '';
    background: url(../video/video-pause.png) no-repeat;
}

.post-center-wrap {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-pack: center;
    justify-content: center;
}

.aspect--1366-768 {
    padding-bottom: 56.22255%;
}

.bp {
    border-radius: 6px;
    background-color: #ffffff;
    box-shadow: 1px 1px 8px 0 rgba(36, 37, 38, 0.08);
}

.bp__wrap {
    padding: 25px;
}

.bp__thumbnail {
    margin-bottom: 12px;
}

.bp__stat {
    margin-bottom: 6px;
}

.bp__stat .bp__stat-wrap {
    margin-right: 22px;
}

.bp__stat .bp__stat-wrap:last-child {
    margin-right: 0;
}

.bp__publish-date>a {
    font-size: 12px;
    font-weight: 600;
    color: #a0a0a0;
}

.bp__author>a {
    font-size: 12px;
    text-decoration: overline;
    font-weight: 600;
    color: #1275C6;
}

.bp__comment>a {
    color: #7f7f7f;
    font-weight: 600;
    font-size: 12px;
}

.bp__category>a {
    color: #a0a0a0;
    font-weight: 600;
    transition: color 110ms ease-in-out;
    font-size: 12px;
    margin-right: 2px;
}

.bp__category>a:last-child {
    margin-right: 0;
}

.bp__category>a:hover {
    color: #1275C6;
}

.bp__h1 {
    display: block;
    margin-bottom: 6px;
}

.bp__h1>a {
    font-size: 20px;
    font-weight: 600;
    color: #333333;
}

.bp__h2 {
    display: block;
    margin-bottom: 16px;
    font-size: 14px;
    font-weight: 400;
    color: #a0a0a0;
}

.bp__p {
    margin-bottom: 12px;
    font-size: 13px;
    color: #7f7f7f;
}

.bp__read-more {
    display: block;
    margin-bottom: 6px;
}

.bp__read-more>a {
    font-size: 14px;
    font-weight: 700;
    color: #1275C6;
}

.bp__social-list {
    margin: 0;
    padding: 0;
    list-style: none;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
}

.bp__social-list>li {
    margin-right: 16px;
}

.bp__social-list>li:last-child {
    margin-right: 0;
}

.bp__social-list>li>a {
    font-size: 14px;
}

.bp--img .bp__thumbnail {
    overflow: hidden;
}

.bp--img .bp__thumbnail img {
    transition: -webkit-transform 0.6s ease-in-out;
    transition: transform 0.6s ease-in-out;
    transition: transform 0.6s ease-in-out, -webkit-transform 0.6s ease-in-out;
    -webkit-transform: scale(1);
    transform: scale(1);
}

.bp--img:hover .bp__thumbnail {
    overflow: hidden;
}

.bp--img:hover .bp__thumbnail img {
    -webkit-transform: scale(1.1);
    transform: scale(1.1);
}

.bp audio,
.bp video,
.bp-mini audio,
.bp-mini video,
.bp-detail audio,
.bp-detail video {
    display: block;
    width: 100%;
}

.blog-m__element {
    width: 33.33%;
    padding: 20px 10px;
}

.bp-mini {
    background-color: #ffffff;
    box-shadow: 2px 2px 8px 0 rgba(36, 37, 38, 0.08);
    overflow: hidden;
    border-radius: 15px;
}

.bp-mini__content {
    padding: 4px 20px 10px;
}

.bp-mini__stat {
    margin-bottom: 2px;
}

.bp-mini__stat .bp-mini__stat-wrap {
    margin-right: 22px;
}

.bp-mini__stat .bp-mini__stat-wrap:last-child {
    margin-right: 0;
}

.bp-mini__publish-date>a {
    font-size: 11px;
    font-weight: 600;
    color: #7f7f7f;
}

.bp-mini__preposition {
    color: #7f7f7f;
    font-size: 12px;
}

.bp-mini__author>a {
    color: #1275C6;
    font-size: 12px;
}

.bp-mini__comment>a {
    color: #7f7f7f;
    font-size: 12px;
}

.bp-mini__category {
    margin-bottom: 4px;
}

.bp-mini__category>a {
    color: #7f7f7f;
    font-weight: 600;
    transition: color 110ms ease-in-out;
    font-size: 11px;
    margin-right: 2px;
}

.bp-mini__category>a:last-child {
    margin-right: 0;
}

.bp-mini__category>a:hover {
    color: #1275C6;
}

.bp-mini__category>a:last-child:after {
    content: none;
}

.bp-mini__h1 {
    display: block;
    margin-bottom: 4px;
}

.bp-mini__h1>a {
    transition: color 110ms ease-in-out;
    font-size: 14px;
    font-weight: 600;
    color: #333333;
}

.bp-mini__h1>a:hover {
    color: #1275C6;
}

.bp-mini__p {
    margin-bottom: 8px;
    font-size: 12px;
    color: #7f7f7f;
}

.bp-mini--img .bp-mini__thumbnail {
    overflow: hidden;
}

.bp-mini--img .bp-mini__thumbnail img {
    transition: -webkit-transform 0.6s ease-in-out;
    transition: transform 0.6s ease-in-out;
    transition: transform 0.6s ease-in-out, -webkit-transform 0.6s ease-in-out;
    -webkit-transform: scale(1);
    transform: scale(1);
}

.bp-mini--img:hover .bp-mini__thumbnail {
    overflow: hidden;
}

.bp-mini--img:hover .bp-mini__thumbnail img {
    -webkit-transform: scale(1.1);
    transform: scale(1.1);
}

.detail-post {
    max-width: 740px;
    padding: 0 15px;
    width: 100%;
    margin: 0 auto;
}

.bp-detail {
    position: relative;
}

.bp-detail__thumbnail {
    margin-bottom: 12px;
}

.bp-detail__stat {
    margin-bottom: 6px;
}

.bp-detail__stat .bp-detail__stat-wrap {
    margin-right: 22px;
}

.bp-detail__stat .bp-detail__stat-wrap:last-child {
    margin-right: 0;
}

.bp-detail__publish-date>a {
    font-size: 12px;
    font-weight: 600;
    color: #a0a0a0;
}

.bp-detail__author>a {
    font-size: 12px;
    text-decoration: overline;
    font-weight: 600;
    color: #1275C6;
}

.bp-detail__category>a {
    color: #a0a0a0;
    font-weight: 600;
    transition: color 110ms ease-in-out;
    font-size: 12px;
    margin-right: 2px;
}

.bp-detail__category>a:last-child {
    margin-right: 0;
}

.bp-detail__category>a:hover {
    color: #1275C6;
}

.bp-detail__h1 {
    display: block;
    margin-bottom: 6px;
}

.bp-detail__h1>a {
    font-size: 20px;
    font-weight: 600;
    color: #333333;
}

.bp-detail__p {
    margin-bottom: 16px;
    color: #333333;
    font-size: 18px;
    line-height: 2;
}

.bp-detail__p a {
    font-weight: 700;
    color: #1275C6;
    transition: all .3s;
}

.bp-detail__p a:hover {
    color: #7f7f7f;
    text-decoration: underline;
}

.bp-detail__q {
    width: 100%;
    text-align: center;
    padding: 3rem;
    margin: 0 0 1rem;
    background-color: #ffffff;
    border-radius: 6px;
    border: 2px solid #1275C6;
}

.bp-detail__q i {
    font-size: 2.125rem;
    color: #333333;
    margin-bottom: 8px;
}

.bp-detail__q-title {
    display: block;
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 8px;
    color: #333333;
}

.bp-detail__q-citation {
    display: block;
    font-size: 12px;
    font-weight: 600;
    color: #7f7f7f;
}

.bp-detail__social-list {
    margin: 0;
    padding: 0;
    list-style: none;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
}

.bp-detail__social-list>li {
    margin-right: 16px;
}

.bp-detail__social-list>li:last-child {
    margin-right: 0;
}

.bp-detail__social-list>li>a {
    font-size: 1.125rem;
}

.bp-detail__postnp {
    margin: 1.375rem 0;
}

.bp-detail__postnp a {
    font-size: 13px;
    border-bottom: 1px solid #333333;
    font-weight: 600;
    color: #333333;
    transition: color 110ms ease-in-out, border-color 110ms ease-in-out;
}

.bp-detail__postnp a:hover {
    color: #1275C6;
    border-color: #1275C6;
}

.blog-w__h {
    display: block;
    vertical-align: middle;
    font-size: 16px;
    color: #333333;
    letter-spacing: 0.03em;
    font-weight: 600;
    margin-bottom: 24px;
    padding-bottom: 12px;
    border-bottom: 1px solid #f7f7f7;
}

.blog-w__list {
    margin: 0;
    padding: 0;
    list-style: none;
}

.blog-w__list>li {
    margin-bottom: 12px;
}

.blog-w__list>li:last-child {
    margin-bottom: 0;
}

.blog-w__list>li>a {
    font-size: 12px;
    font-weight: 600;
    color: #7f7f7f;
}

.blog-w__list>li>a:hover {
    color: #333333;
}

.blog-search-form {
    position: relative;
    width: 100%;
}

.blog-search-form .input-text {
    width: 100%;
    border-radius: 6px;
}

.blog-search-form .btn {
    position: absolute;
    top: 50%;
    right: 15px;
    -webkit-transform: translateY(-50%);
    transform: translateY(-50%);
    font-size: 18px;
}

.blog-w__b-l {
    margin: 0;
    padding: 0;
    list-style: none;
}

.blog-w__b-l>li {
    margin-bottom: 30px;
}

.blog-w__b-l>li:last-child {
    margin-bottom: 0;
}

.blog-w__b-l-2 {
    margin: 0;
    padding: 0;
    list-style: none;
}

.blog-w__b-l-2>li {
    margin-bottom: 8px;
}

.blog-w__b-l-2>li:last-child {
    margin-bottom: 0;
}

.b-l__date {
    font-size: 10px;
    color: #a0a0a0;
    display: block;
    margin-bottom: 6px;
}

.b-l__text {
    font-size: 12px;
    color: #7f7f7f;
}

.b-l__h {
    display: block;
    margin-bottom: 6px;
}

.b-l__h>a {
    font-size: 12px;
    transition: color 110ms ease-in-out;
    color: #333333;
    font-weight: 600;
}

.b-l__h>a:hover {
    color: #1275C6;
}

.b-l__h-2>a {
    font-size: 12px;
    transition: color 110ms ease-in-out;
    color: #333333;
    font-weight: 600;
}

.b-l__h-2>a:hover {
    color: #1275C6;
}

.b-l__p {
    display: block;
    font-size: 12px;
    color: #7f7f7f;
}

.blog-pg {
    margin: 0;
    padding: 0;
    list-style: none;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: center;
    align-items: center;
}

.blog-pg>li {
    margin-right: 14px;
}

.blog-pg>li:last-child {
    margin-right: 0;
}

.blog-pg>li>a {
    width: 42px;
    text-align: center;
    height: 42px;
    line-height: 42px;
    font-size: 12px;
    display: block;
    font-weight: 600;
    border-radius: 50%;
    background-color: transparent;
    color: #333333;
}

.blog-pg>li>a:hover {
    background-color: #1275C6;
    color: #ffffff;
}

.blog-pg>li.blog-pg--active>a {
    background-color: #1275C6;
    color: #ffffff;
    border-color: #1275C6;
}

.d-meta__text {
    display: block;
    color: #333333;
    font-size: 32px;
    font-weight: 700;
}

.d-meta__text-2 {
    display: block;
    color: #333333;
    font-size: 18px;
    font-weight: 600;
}

.d-meta__text-3 {
    display: block;
    color: #7f7f7f;
    font-size: 12px;
}

.d-meta__comments ol {
    margin: 0;
    padding: 0;
    list-style: none;
}

.d-meta__comments .comment-children {
    padding-left: 1rem;
}

.d-meta__p-comment {
    display: -ms-flexbox;
    display: flex;
    margin-bottom: 1.5rem;
}

.p-comment__wrap1 {
    margin-right: 20px;
}

.p-comment__img-wrap {
    width: 80px;
    height: 80px;
    background-color: #f5f5f5;
}

.p-comment__author {
    display: block;
    margin-bottom: 2px;
    font-size: 14px;
    font-weight: 600;
    color: #333333;
}

.p-comment__timestamp {
    display: block;
    margin-bottom: 2px;
}

.p-comment__timestamp a {
    font-size: 12px;
    font-weight: 600;
    color: #7f7f7f;
    transition: color 110ms ease-in-out;
}

.p-comment__timestamp a:hover {
    color: #1275C6;
}

.p-comment__paragraph {
    color: #7f7f7f;
    font-size: 13px;
    margin-bottom: 8px;
    width: 100%;
    max-width: 470px;
}

.p-comment__reply {
    font-size: 13px;
    font-weight: 600;
    color: #1275C6;
    border-bottom: 0;
}

.p-comment__reply:hover {
    border-bottom: 1px solid #1275C6;
}

.respond__form {
    width: 100%;
}

.respond__form .btn,
.respond__form .input-text,
.respond__form .text-area {
    border-radius: 6px;
}

.respond__form .input-text,
.respond__form .text-area {
    width: 100%;
}

.respond__form .text-area {
    height: 15.625rem;
}

.respond__form .btn {
    font-weight: 600;
    padding: 16px 46px;
}

.respond__group {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: nowrap;
    flex-wrap: nowrap;
}

.respond__group div {
    -ms-flex: 1;
    flex: 1;
    margin-right: 14px;
}

.respond__group div:last-child {
    margin-right: 0;
}

@media (max-width: 991px) {
    .blog-m__element {
        width: 50%;
    }
    .respond__group {
        display: block;
    }
    .respond__group div {
        display: block;
        margin-right: 0;
    }
}

@media (max-width: 767px) {
    .blog-m__element {
        width: 100%;
    }
}


/*--------------------------------------------------------------
18.0 Product-Detail-Pages
--------------------------------------------------------------*/

.pd-breadcrumb__list {
    list-style: none;
    padding: 0;
    margin: 0;
    word-wrap: break-word;
}

.pd-breadcrumb__list>li {
    display: inline-block;
}

.pd-breadcrumb__list>li>a {
    color: #a0a0a0;
    font-size: 12px;
    transition: color 0.5s;
}

.pd-breadcrumb__list>li>a:hover {
    color: #333333;
}

.pd-breadcrumb__list>li.is-marked>a {
    color: #333333;
    font-weight: 700;
}

.pd-breadcrumb__list>li.has-separator:after {
    content: '-';
    margin: 0 6px;
}

.pd {
    cursor: pointer;
}

.pd-wrap {
    position: relative;
}

.pd-text {
    position: absolute;
    top: 15px;
    padding: 8px;
    right: 15px;
    font-size: 12px;
    color: #333333;
}

.pd-social-list {
    margin: 0;
    padding: 0;
    list-style: none;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
}

.pd-social-list>li {
    margin-right: 16px;
}

.pd-social-list>li:last-child {
    margin-right: 0;
}

.pd-social-list>li>a {
    font-size: 1.125rem;
    transition: color 110ms ease-in-out;
    color: #333333;
}

.pd-detail__label {
    display: block;
    font-size: 14px;
    font-weight: 700;
    color: #333333;
}

.pd-detail__inline span {
    margin-right: 0.375rem;
}

.pd-detail__inline span:last-child {
    margin-right: 0;
}

.pd-detail-inline-2 {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: nowrap;
    flex-wrap: nowrap;
    -ms-flex-align: center;
    align-items: center;
}

.pd-detail-inline-2 div {
    margin-right: 14px;
}

.pd-detail-inline-2 div:last-child {
    margin-right: 0;
}

.pd-detail__name {
    display: block;
    color: #333333;
    font-size: 16px;
    font-weight: 600;
}

.pd-detail__price {
    color: #ff4500;
    font-size: 2rem;
    font-weight: 700;
}

.pd-detail__discount {
    color: #ff4500;
    font-size: 14px;
    font-weight: 600;
    transition: color 0.5s;
}

.pd-detail__del {
    color: #a0a0a0;
    font-size: 12px;
}

.pd-detail__rating {
    display: block;
}

.pd-detail__rating i {
    font-size: 12px;
}

.pd-detail__review>a {
    font-size: 12px;
    transition: color 110ms ease-in-out;
    color: #333333;
}

.pd-detail__review>a:hover {
    color: #1275C6;
    text-decoration: underline;
}

.pd-detail__stock,
.pd-detail__left {
    font-size: 12px;
    font-weight: 600;
    padding: 8px;
    display: inline-block;
    border-radius: 30px;
}

.pd-detail__stock {
    background-color: rgba(0, 148, 68, 0.14);
    color: #009444;
}

.pd-detail__left {
    background-color: rgba(255, 69, 0, 0.14);
    color: #ff4500;
}

.pd-detail__preview-desc {
    font-size: 13px;
    color: #7f7f7f;
}

.pd-detail__click-wrap>a {
    font-size: 13px;
    color: #a0a0a0;
    transition: color 110ms ease-in-out;
}

.pd-detail__click-wrap>a:hover {
    color: #b6b6b6;
    text-decoration: underline;
}

.pd-detail__click-count {
    font-size: 10px;
    color: #a0a0a0;
}

.pd-detail__form {
    width: 100%;
}

.pd-detail__form .btn {
    padding: 12px 20px;
    border-radius: 0.375rem;
}

.buy-btn button {
    border: none;
}

.buy-btn2 button {
    margin-left: 7px;
}


/**
  * Variations
 */

.pd-detail__color,
.pd-detail__size {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
}

.color__radio {
    position: relative;
    line-height: 1.89;
    margin-right: 36px;
    display: inline-block;
}

.color__radio [type="radio"] {
    position: absolute;
    left: 0;
    top: 0;
    min-width: 30px;
    width: 100%;
    height: 100%;
    z-index: 2;
    opacity: 0;
    cursor: pointer;
}

.color__radio-label {
    position: initial;
    display: inline-block;
}

.color__radio-label:before,
.color__radio-label:after {
    content: '';
    width: 30px;
    height: 30px;
    display: block;
    border: 2px solid transparent;
    z-index: 0;
    position: absolute;
    left: 0;
    top: 0;
}

.color__radio-label:after {
    -webkit-transform: scale(0.6);
    transform: scale(0.6);
    background-color: inherit;
}

.color__radio input:checked+label:before {
    border-color: #d2d2d2;
}

.size__radio {
    position: relative;
    margin: 0 12px 12px 0;
}

.size__radio [type="radio"] {
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    z-index: 2;
    opacity: 0;
    cursor: pointer;
}

.size__radio-label {
    border: 1px solid rgba(0, 0, 0, 0.08);
    padding: 7px 15px;
    background-color: #ffffff;
    font-size: 13px;
    color: #333333;
    cursor: pointer;
    display: inline-block;
}

.size__radio input:checked+label {
    border-color: #333333;
}

.pd-detail__policy-list {
    margin: 0;
    padding-left: 26px;
    font-size: 14px;
    list-style: none;
}

.pd-detail__policy-list>li i {
    color: #009444;
}

.pd-detail__policy-list>li span {
    color: #7f7f7f;
}

.pd-tab__list {
    margin: 0;
    border-bottom: 2px solid #e7e7e7;
}

.pd-tab__list>li {
    margin-bottom: -2px;
}

.pd-tab__list>li>a {
    padding: 10px 0;
    color: #333333;
    font-size: 14px;
    font-weight: 700;
    border-bottom: 2px solid transparent;
    border-top-left-radius: 3px;
    border-top-right-radius: 3px;
    letter-spacing: .01rem;
    transition: all .3s;
}

.pd-tab__list>li>a span {
    margin-left: 2px;
    font-size: 12px;
}

.pd-tab__list>li>a.active {
    color: #000000;
    border-color: #000000;
}

.pd-tab__list>li+li {
    margin-left: 28px;
}

.pd-tab__desc,
.pd-tab__tag {
    max-width: 691px;
}

.pd-tab__desc p {
    color: #333333;
    font-size: 16px;
    line-height: 2;
}

.pd-tab__desc ul {
    margin: 0;
    padding-left: 16px;
    list-style: none;
}

.pd-tab__desc ul>li {
    margin-bottom: 7px;
    color: #333333;
    font-size: 14px;
}

.pd-tab__desc h4 {
    color: #333333;
    font-size: 16px;
    font-weight: 700;
    line-height: 1.4;
}

.pd-tab__desc .pd-table {
    overflow: auto;
}

.pd-tab__desc .pd-table table {
    width: 100%;
    border-radius: 2px;
    border: 1px solid #eee;
    border-collapse: collapse;
}

.pd-tab__desc .pd-table tbody tr {
    border-bottom: 1px solid #eee;
}

.pd-tab__desc .pd-table tbody td {
    font-size: 14px;
    color: #7f7f7f;
    padding: 12px;
}

.pd-tab__desc .pd-table tbody td:first-child {
    color: #333333;
    font-weight: 600;
}

.pd-tab__tag h2 {
    font-size: 16px;
    font-weight: 700;
    color: #333333;
    line-height: 1.18;
}

.pd-tab__tag form {
    width: 100%;
}

.pd-tab__tag form .btn {
    font-size: 13px;
    font-weight: 600;
    border: 0;
    height: 48px;
    padding: 17px 18px;
}

.pd-tab__tag form .input-text {
    height: 48px;
    margin-right: 8px;
    width: 50%;
}

.pd-tab__rev-f1 {
    width: 100%;
}

.pd-tab__rev-score {
    padding: 40px 0;
    text-align: center;
    background-color: #f6f6f6;
}

.pd-tab__rev-score h2 {
    font-size: 16px;
    font-weight: 600;
    line-height: 0.875;
    color: #333333;
}

.pd-tab__rev-score h4 {
    font-size: 14px;
    font-weight: 700;
    line-height: 0.875;
    color: #333333;
}

.rev-f1__group {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: center;
    align-items: center;
    -ms-flex-pack: justify;
    justify-content: space-between;
}

.rev-f1__group h2 {
    font-size: 16px;
    font-weight: 700;
    color: #333333;
    line-height: 1.18;
}

.rev-f1__group .select-box {
    border-radius: 0.375rem;
}

.rev-f1__review {
    max-width: 691px;
}

.review-o {
    padding: 1rem 0;
    border-bottom: 1px solid #f0f0f0;
}

.review-o__name {
    font-size: 14px;
    font-weight: 600;
    color: #333333;
}

.review-o__date {
    margin-left: 6px;
    font-size: 11px;
    font-weight: 600;
    color: #7f7f7f;
}

.review-o__rating span {
    margin-left: 2px;
    font-size: 11px;
    font-weight: 600;
    color: #7f7f7f;
}

.review-o__text {
    font-size: 13px;
    color: #7f7f7f;
}

.pd-tab__rev-f2 {
    width: 100%;
}

.pd-tab__rev-f2 h2 {
    font-size: 32px;
    color: #333333;
    line-height: 0.90;
}

.pd-tab__rev-f2 .input-text,
.pd-tab__rev-f2 .text-area {
    width: 100%;
}

.pd-tab__rev-f2 .text-area {
    height: 15.625rem;
}

.pd-tab__rev-f2 .btn {
    font-weight: 600;
    padding: 16px 46px;
    border-radius: 5px;
}

.rev-f2__table-wrap {
    overflow: auto;
}

.rev-f2__table {
    width: 100%;
    table-layout: fixed;
    text-align: center;
    border-collapse: collapse;
    border: 1px solid #dee2e6;
}

.rev-f2__table th,
.rev-f2__table td {
    padding: 16px 4px;
    border: 1px solid #d6d6d6;
}

.rev-f2__table th {
    width: 120px;
    color: #333333;
    background-color: #f0f0f0;
    font-size: 13px;
}

.rev-f2__table th span {
    margin-top: 2px;
    display: block;
    font-size: 11px;
    color: #333333;
}

.rev-f2__group {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: nowrap;
    flex-wrap: nowrap;
}

.rev-f2__group div {
    -ms-flex: 1;
    flex: 1;
    margin-right: 14px;
}

.rev-f2__group div:last-child {
    margin-right: 0;
}

@media (max-width: 991px) {
    .pd-text {
        display: none;
    }
    .zoomContainer {
        display: none;
    }
    .rev-f2__group {
        display: block;
    }
    .rev-f2__group div {
        display: block;
        margin-right: 0;
    }
}

@media (max-width: 575px) {
    .pd-detail-inline-2 {
        display: block;
    }
    .pd-detail-inline-2 div {
        display: block;
        margin-right: 0;
    }
    .rev-f1__group {
        display: block;
    }
}


/*--------------------------------------------------------------
19.0 Shop-Pages
--------------------------------------------------------------*/

.shop-w-master__heading {
    font-size: 18px;
    color: #333333;
    font-weight: 700;
    line-height: 20px;
}

.sidebar--bg-snow {
    background-color: #f9f9f9;
}

.shop-w--style {
    border: 1px solid #f1f1f1;
    background-color: #ffffff;
    box-shadow: 0 6px 15px 0 rgba(36, 37, 38, 0.08);
}

.shop-w__intro-wrap {
    position: relative;
}

.shop-w__h {
    font-size: 14px;
    padding: 14px 18px;
    border-bottom: 1px solid #efefef;
    color: #333333;
    font-weight: 700;
    line-height: 20px;
}

.shop-w__wrap {
    padding: 14px;
}

.shop-w__toggle.collapsed:before {
    content: "\F067";
}

.shop-w__toggle {
    position: absolute;
    top: 50%;
    padding: 8px 12px;
    background-color: transparent;
    -webkit-transform: translateY(-50%);
    transform: translateY(-50%);
    right: 10px;
    font-size: 12px;
    cursor: pointer;
    color: #444;
}

.shop-w ul {
    margin: 0;
    padding-left: 0;
    list-style: none;
}

.shop-w__list {
    overflow: auto;
    max-height: 290px;
}

.shop-w__list>li {
    position: relative;
    padding: 8px 16px;
}

.shop-w__list-2 {
    overflow: auto;
    max-height: 290px;
}

.shop-w__list-2>li {
    padding: 0.25rem 0;
    position: relative;
}

.list__content {
    position: relative;
}

.list__content [type="checkbox"] {
    position: absolute;
    left: 0;
    top: 0;
    min-width: 16px;
    width: 100%;
    height: 100%;
    z-index: 2;
    opacity: 0;
    cursor: pointer;
}

.list__content span {
    padding: 8px 16px;
    display: block;
    font-size: 14px;
    transition: background-color 110ms ease-in-out, color 110ms ease-in-out;
    color: #7f7f7f;
}

.list__content:hover span {
    color: #333333;
    background-color: #ececec;
    border-radius: .5rem;
}

.list__content input:checked+span {
    background-color: #ececec;
    color: #333333;
    border-radius: .5rem;
}

.shop-w__total-text {
    font-size: 11px;
    position: absolute;
    cursor: pointer;
    top: 50%;
    -webkit-transform: translateY(-50%);
    transform: translateY(-50%);
    color: #333333;
    right: 13px;
}

.shop-w__category-list {
    overflow: auto;
    max-height: 290px;
}

.shop-w__category-list>li {
    padding: 4px 14px;
}

.shop-w__category-list>li>a {
    font-size: 14px;
    color: #333333;
    transition: color 110ms ease-in-out;
}

.shop-w__category-list>li>a:hover {
    color: #1275C6;
}

.shop-w__category-list>li ul .has-list>a {
    font-size: 13px;
    font-weight: 700;
    color: #333333;
}

.shop-w__category-list>li ul {
    display: none;
    padding-left: 8px;
}

.shop-w__category-list>li ul li a {
    font-size: 13px;
    color: #7f7f7f;
    transition: color 110ms ease-in-out;
}

.shop-w__category-list>li ul li a:hover {
    color: #1275C6;
}

.has-list {
    position: relative;
}

.category-list__text {
    font-size: 10px;
    color: #a0a0a0;
}

.js-shop-category-span {
    cursor: pointer;
    font-size: 13px;
    color: #444;
    transition: color 110ms ease-in-out;
}

.js-shop-category-span:hover {
    color: #000000;
}

.js-shop-category-span.is-expanded:before {
    content: '\f068';
}

.shop-w__form-p-wrap {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    padding: 8px 0;
}

.shop-w__form-p-wrap div {
    margin-right: 8px;
    margin-bottom: 12px;
}

.shop-w__form-p-wrap div:last-child {
    margin-right: 0;
}

.shop-w__form-p-wrap .input-text,
.shop-w__form-p-wrap .btn {
    height: 40px;
    padding: 8px;
    border-radius: 2px;
}

.shop-w__form-p-wrap .input-text {
    width: 80px;
}

.shop-w__form-p-wrap .btn {
    width: 40px;
}

.color__check {
    position: relative;
    line-height: 1.89;
    margin-right: 36px;
    display: inline-block;
}

.color__check [type="checkbox"] {
    position: absolute;
    left: 0;
    top: 0;
    min-width: 30px;
    width: 100%;
    height: 100%;
    z-index: 2;
    opacity: 0;
    cursor: pointer;
}

.color__check-label {
    position: initial;
    display: inline-block;
}

.color__check-label:before,
.color__check-label:after {
    content: '';
    width: 30px;
    height: 30px;
    display: block;
    border: 2px solid transparent;
    z-index: 0;
    position: absolute;
    left: 0;
    top: 0;
}

.color__check-label:after {
    -webkit-transform: scale(0.6);
    transform: scale(0.6);
    background-color: inherit;
}

.color__check input:checked+label:before {
    border-color: #d2d2d2;
}

.rating__check {
    position: relative;
    cursor: pointer;
}

.rating__check [type="checkbox"] {
    position: absolute;
    left: 0;
    top: 0;
    min-width: 16px;
    width: 100%;
    height: 100%;
    z-index: 2;
    opacity: 0;
    cursor: pointer;
}

.rating__check-star-wrap>i {
    margin-left: 2px;
    color: #fa9600;
    transition: color .4s ease-in-out;
}

.rating__check-star-wrap>i:first-child {
    margin-left: 0;
}

.rating__check-star-wrap span {
    font-size: 12px;
    color: #333333;
    margin-right: 2px;
}

.rating__check:hover .rating__check-star-wrap>i {
    color: #ff9600;
}

.rating__check input:checked+.rating__check-star-wrap>i {
    color: #ff9600;
}

.shop-p__meta-wrap {
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
    padding: 20px;
    border-radius: 0.625rem;
}

.shop-p__meta-text-1 {
    display: block;
    font-size: 14px;
    margin-bottom: 6px;
    font-weight: 700;
    color: #333333;
}

.shop-p__meta-text-2 {
    font-size: 14px;
    font-weight: 700;
    color: #7f7f7f;
}

.shop-p__tool-style {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: center;
    align-items: center;
    -ms-flex-pack: justify;
    justify-content: space-between;
}

.tool-style__group {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
}

.tool-style__group span {
    position: relative;
    display: inline-block;
    height: 40px;
    cursor: pointer;
    border: 2px solid #e5e5e5;
    font-size: 13px;
    padding: 8px 18px;
    font-weight: 700;
    color: #333333;
}

.tool-style__group span:hover {
    background-color: rgba(255, 69, 0, 0.12);
    color: #1275C6;
    border-color: #1275C6;
    z-index: 2;
}

.tool-style__group span:not(:last-child) {
    margin-right: -2px;
}

.tool-style__group span.is-active {
    background-color: rgba(255, 69, 0, 0.12);
    color: #1275C6;
    border-color: #1275C6;
    z-index: 2;
}

.tool-style__form-wrap {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: center;
    align-items: center;
}

.tool-style__form-wrap div+div {
    margin-left: 15px;
}

.tool-style__form-wrap select {
    border-radius: .25rem;
}

.is-grid-active .product-m {
    position: relative;
    margin-bottom: 30px;
    transition: 0.3s;
}

.is-grid-active .product-m__thumb {
    position: relative;
}

.is-grid-active .product-m__add-cart {
    position: absolute;
    bottom: 30px;
    left: 60px;
    right: 15px;
    opacity: 0;
    visibility: hidden;
    transition: 0.3s;
}

.is-grid-active .product-m__add-cart>a {
    padding: 10px;
    border-radius: 0.125rem;
    font-size: 13px;
    text-align: center;
    margin-left: 20px;
    margin-bottom: -10px;
    border-radius: 10px;
}

.product-m__add-cart .bag-icon {
    padding: 10px 12px!important;
}

.is-list-active .offer-icon {
    margin-left: 45px;
}

.is-grid-active .product-m__quick-look {
    position: absolute;
    top: 8px;
    right: 22px;
    opacity: 0;
    visibility: hidden;
    transition: 0.3s;
}

.is-grid-active .product-m__quick-look>a {
    font-size: 16px;
    color: #ff4500;
    transition: color 110ms ease-in-out;
}

.is-grid-active .product-m__quick-look>a:hover {
    color: #ff4500;
}

.is-grid-active .product-m__content {
    padding: 4px 16px 6px;
}

.is-grid-active .product-m__category {
    margin-bottom: 2px;
    line-height: 1.2;
}

.is-grid-active .product-m__category>a {
    color: #a0a0a0;
    transition: color 0.5s;
    font-size: 12px;
}

.is-grid-active .product-m__category>a:hover {
    color: #1275C6;
}

.is-grid-active .product-m__name>a {
    color: #333333;
    font-size: 14px;
    font-weight: 600;
    transition: color 0.5s;
}

.is-grid-active .product-m__name>a:hover {
    color: #1275C6;
}

.is-grid-active .product-m__price {
    line-height: 1.2;
    color: #333333;
    font-size: 14px;
    font-weight: 600;
}

.is-grid-active .product-m__discount {
    font-weight: 600;
    margin-left: 30px;
    color: #fa4500;
    font-size: 14px;
    text-decoration: line-through;
}

.is-grid-active .product-m__rating {
    margin-bottom: 6px;
}

.is-grid-active .product-m__rating i {
    font-size: 12px;
}

.is-grid-active .product-m__review {
    margin-left: 4px;
    font-size: 11px;
    color: #a0a0a0;
}

.is-grid-active .product-m__hover {
    position: absolute;
    top: 96%;
    width: 100%;
    z-index: 9;
    padding: 4px 16px 14px;
    left: 0;
    background: #ffffff;
    box-shadow: 0 6px 7px 0 rgba(0, 0, 0, 0.2);
    transition: all 300ms ease-in-out;
    opacity: 0;
    visibility: hidden;
}

.is-grid-active .product-m__wishlist {
    text-align: right;
}

.is-grid-active .product-m__wishlist a {
    font-size: 16px;
    color: #a0a0a0;
    transition: color 110ms ease-in-out;
}

.is-grid-active .product-m__wishlist a:hover {
    color: #1275C6;
}

.is-grid-active .product-m__preview-description {
    margin-bottom: 8px;
    font-size: 12px;
    color: #7f7f7f;
}

.is-grid-active .product-m:hover {
    box-shadow: 0 0 15px 0 rgba(0, 0, 0, 0.2);
}

.is-grid-active .product-m:hover .product-m__add-cart {
    opacity: 1;
    visibility: visible;
}

.is-grid-active .product-m:hover .product-m__quick-look {
    opacity: 1;
    visibility: visible;
}

.is-grid-active .product-m:hover .product-m__hover {
    top: 99%;
    opacity: 1;
    visibility: visible;
}

.is-list-active {
    display: block;
}

.is-list-active [class*="col-"] {
    display: block;
    max-width: 100%;
    width: 100%;
}

.is-list-active .product-m {
    padding: 15px 0;
    transition: 0.3s;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
}

.is-list-active .product-m__thumb {
    position: relative;
    -ms-flex: 0 0 33.33333%;
    flex: 0 0 33.33333%;
    max-width: 33.33333%;
    padding-right: 15px;
    padding-left: 15px;
}

.is-list-active .product-m__add-cart {
    position: absolute;
    bottom: 30px;
    left: 70px;
    right: 15px;
    opacity: 0;
    visibility: hidden;
    transition: 0.3s;
}

.is-list-active .product-m__add-cart>a {
    padding: 10px;
    border-radius: 0.125rem;
    font-size: 13px;
    text-align: center;
    margin-left: 20px;
    margin-bottom: -10px;
    border-radius: 10px;
}

.is-list-active .product-m__quick-look {
    position: absolute;
    top: 8px;
    right: 22px;
    opacity: 0;
    visibility: hidden;
    transition: 0.3s;
}

.is-list-active .product-m__quick-look>a {
    font-size: 16px;
    color: #ff4500;
    transition: color 110ms ease-in-out;
    margin-right: 10px;
}

.is-list-active .product-m__quick-look>a:hover {
    color: #fa4400;
}

.is-list-active .product-m__content {
    position: relative;
    -ms-flex: 0 0 66.66667%;
    flex: 0 0 66.66667%;
    max-width: 66.66667%;
    padding-right: 15px;
    padding-left: 15px;
}

.is-list-active .product-m__category {
    margin-bottom: 2px;
    line-height: 1.2;
}

.is-list-active .product-m__category>a {
    color: #a0a0a0;
    transition: color 0.5s;
    font-size: 12px;
}

.is-list-active .product-m__category>a:hover {
    color: #1275C6;
}

.is-list-active .product-m__name>a {
    color: #333333;
    font-size: 14px;
    font-weight: 600;
    transition: color 0.5s;
}

.is-list-active .product-m__name>a:hover {
    color: #1275C6;
}

.is-list-active .product-m__price {
    margin-bottom: 8px;
    line-height: 1.2;
    color: #333333;
    font-size: 14px;
    font-weight: 600;
}

.is-list-active .product-m__discount {
    font-weight: 600;
    margin-left: 30px;
    color: #fa4400;
    font-size: 14px;
    text-decoration: line-through;
}

.is-list-active .product-m__rating {
    margin-bottom: 6px;
}

.is-list-active .product-m__rating i {
    font-size: 12px;
}

.is-list-active .product-m__review {
    margin-left: 4px;
    font-size: 11px;
    color: #a0a0a0;
}

.is-list-active .product-m__preview-description {
    font-size: 12px;
    color: #7f7f7f;
}

.is-list-active .product-m__wishlist {
    position: absolute;
    right: 12px;
    bottom: 13px;
}

.is-list-active .product-m__wishlist a {
    font-size: 16px;
    color: #a0a0a0;
    transition: color 110ms ease-in-out;
}

.is-list-active .product-m__wishlist a:hover {
    color: #1275C6;
}

.is-list-active .product-m:hover {
    background: #ffffff;
    border-radius: 0.1875rem;
    box-shadow: 0 0 15px 0 rgba(0, 0, 0, 0.2);
}

.is-list-active .product-m:hover .product-m__add-cart {
    opacity: 1;
    visibility: visible;
}

.is-list-active .product-m:hover .product-m__quick-look {
    opacity: 1;
    visibility: visible;
}

.shop-p__pagination {
    margin: 0;
    padding: 0;
    list-style: none;
    -ms-flex-pack: center;
    justify-content: center;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: center;
    align-items: center;
}

.shop-p__pagination>li {
    margin-right: 14px;
}

.shop-p__pagination>li:last-child {
    margin-right: 0;
}

.shop-p__pagination>li>a {
    width: 42px;
    text-align: center;
    height: 42px;
    line-height: 42px;
    font-size: 12px;
    display: block;
    font-weight: 600;
    border-radius: 50%;
    background-color: transparent;
    color: #333333;
}

.shop-p__pagination>li.is-active>a {
    background-color: #f7f7f7;
}

.shop-p__pagination>li:not(.is-active)>a:hover {
    color: #1275C6;
    text-decoration: underline;
}

.shop-a__wrap {
    position: fixed;
    top: 0;
    width: 350px;
    min-height: 100vh;
    bottom: 0;
    z-index: 9999;
    right: 0;
    transition: all 400ms ease-out;
    -webkit-transform: translate(200px, 0);
    transform: translate(200px, 0);
    box-shadow: 0 0 7px 2px rgba(0, 0, 0, 0.09);
    background-color: #ffffff;
    visibility: hidden;
    opacity: 0;
}

.shop-a__inner {
    overflow: auto;
    height: 100%;
    padding: 1.25rem 1.125rem;
}

.shop-a.is-open .shop-a__wrap {
    -webkit-transform: translate(0, 0);
    transform: translate(0, 0);
    visibility: visible;
    opacity: 1;
}

@media (max-width: 575px) {
    .is-list-active .product-m__thumb {
        margin-bottom: 30px;
        -ms-flex: 0 0 100%;
        flex: 0 0 100%;
        max-width: 100%;
    }
    .is-list-active .product-m__content {
        -ms-flex: 0 0 100%;
        flex: 0 0 100%;
        max-width: 100%;
    }
    .is-list-active .product-m__wishlist {
        position: static;
        text-align: right;
    }
    .shop-p__tool-style {
        display: block;
    }
    .tool-style__form-wrap {
        display: block;
    }
    .tool-style__form-wrap div+div {
        margin-left: 0;
    }
}


/*--------------------------------------------------------------
20.0 Vendor Extension Pages
--------------------------------------------------------------*/


/*--------------------------------------------------------------
20.1 Bootstrap
--------------------------------------------------------------*/


/* Modal styles */

.modal {
    z-index: 999999;
}

.modal-content {
    display: block !important;
    border: none;
    border-radius: 0;
}

.modal--radius {
    border-radius: 8px;
}

.modal--shadow {
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.45);
}


/* Tootip styles */

.tooltip {
    font-family: "Open Sans", -apple-system, system-ui, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    font-size: 12px;
    font-weight: 600;
}

.tooltip.show {
    opacity: 1;
}

.bs-tooltip-top .arrow::before,
.bs-tooltip-auto[x-placement^="top"] .arrow::before {
    border-top-color: #f5f5f5;
}

.bs-tooltip-right .arrow::before,
.bs-tooltip-auto[x-placement^="right"] .arrow::before {
    border-right-color: #f5f5f5;
}

.bs-tooltip-bottom .arrow::before,
.bs-tooltip-auto[x-placement^="bottom"] .arrow::before {
    border-bottom-color: #f5f5f5;
}

.bs-tooltip-left .arrow::before,
.bs-tooltip-auto[x-placement^="left"] .arrow::before {
    border-left-color: #f5f5f5;
}

.tooltip-inner {
    color: #333333;
    background-color: #f5f5f5;
    border-radius: 2px;
}

@media (max-width: 991px) {
    .tooltip.show {
        opacity: 0;
    }
}


/*--------------------------------------------------------------
20.2 jquery.shopnav
--------------------------------------------------------------*/

.ah-list {
    margin: 0;
    padding: 0;
}

.ah-list li {
    list-style: none;
}

.ah-list ul {
    margin: 0;
    padding: 0;
}

.ah-list--design1>li {
    display: inline-block;
}

.ah-list--design1>li>a {
    display: inline-block;
    font-size: 16px;
    padding: 28px 18px;
}

.ah-list--link-color-secondary>li>a {
    color: #333333;
}

.ah-list--link-color-white>li>a {
    color: #ffffff;
}

.ah-list--design2>li {
    display: inline-block;
}

.ah-list--design2>li>a {
    font-weight: 700;
    font-size: 12px;
    display: inline-block;
    padding: 31px 14px;
}

.has-dropdown>ul .has-dropdown {
    position: relative;
}

.has-dropdown>ul {
    background-color: #ffffff;
    box-shadow: 0 0 4px 0 rgba(0, 0, 0, 0.13);
    position: absolute;
    text-align: left;
    padding: 20px 0 20px;
    z-index: 999;
    white-space: nowrap;
    transition: all 0.3s ease;
    top: 120%;
    opacity: 0;
    visibility: hidden;
}

.has-dropdown>ul>li>a {
    display: block;
    padding: 8px 20px;
    color: #333333;
    font-size: 12px;
    font-weight: 600;
}

.has-dropdown--ul-left-100>ul {
    left: 100%;
}

.has-dropdown--ul-right-100>ul {
    right: 100%;
}

@media (max-width: 1024px) {
    .menu-init .fa-angle-down:before {
        content: none;
    }
    .menu-init.js-open .ah-lg-mode {
        left: 0;
        transition: all .4s ease-in-out;
    }
    .menu-init.js-open:after {
        content: "";
        width: 100%;
        height: 100%;
        position: fixed;
        top: 0;
        left: 0;
        display: block;
        background-color: rgba(0, 0, 0, 0.7);
        z-index: 19999;
    }
    .ah-lg-mode {
        position: fixed;
        left: -315px;
        width: 315px;
        height: 100%;
        top: 0;
        background-color: #ffffff;
        z-index: 20000;
        overflow-y: auto;
    }
    .ah-close {
        color: #333333;
        padding: 20px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        display: block;
    }
    .ah-list>li {
        position: relative;
        display: block;
        border-top: 1px solid #f8f8f8;
    }
    .ah-list>li>a {
        display: block;
        padding: 8px 18px;
    }
    .ah-list>li:last-child {
        border-bottom: 1px solid #f8f8f8;
    }
    .ah-list--design1>li>a,
    .ah-list--design2>li>a {
        font-weight: normal;
        font-size: 14px;
    }
    .ah-list--link-color-white>li>a {
        color: #333333;
    }
    .js-menu-toggle {
        width: 21px;
        display: block;
        height: 21px;
        border-radius: 50%;
        background-color: #ffffff;
        box-shadow: 1px 1px 0 0 rgba(0, 0, 0, 0.13);
        position: absolute;
        right: 15px;
        top: 6px;
        transition: all .3s;
        cursor: pointer;
    }
    .js-menu-toggle:after {
        font-family: 'Font Awesome 5 Free';
        content: "\F067";
        position: absolute;
        top: 50%;
        width: 100%;
        font-weight: 900;
        color: #333333;
        display: block;
        -webkit-transform: translateY(-50%);
        transform: translateY(-50%);
        text-align: center;
        font-size: 8px;
    }
    .js-menu-toggle.js-toggle-mark:after {
        content: "\F068";
    }
    .has-dropdown>ul {
        width: 100% !important;
        box-shadow: none;
        transition: none;
        position: static;
        padding: 0 0 10px;
        opacity: 1;
        visibility: visible;
        display: none;
    }
    .has-dropdown>ul>li {
        padding: 0;
    }
    .has-dropdown>ul>li>a {
        display: block;
    }
    .ah-list>li>ul>li>a {
        padding: 8px 36px;
    }
    .ah-list>li>ul>li>ul>li>a {
        padding: 8px 54px;
    }
    .ah-list>li>ul>li>ul>li>ul>li>a {
        padding: 8px 72px;
    }
}

@media (min-width: 1025px) {
    .toggle-button {
        display: none;
    }
    .ah-close {
        display: none;
    }
    .ah-list>li>a:hover {
        color: #1275C6;
    }
    .has-dropdown>ul>li:hover {
        background-color: #fbfbfb;
    }
    .has-dropdown:hover>ul {
        opacity: 1;
        visibility: visible;
    }
    .ah-list>.has-dropdown:hover>ul {
        top: 100%;
    }
    .has-dropdown .has-dropdown:hover>ul {
        top: 0;
    }
    .ah-list>.has-dropdown:hover>a {
        color: #1275C6;
    }
    .has-dropdown>a .fa-angle-down {
        font-size: 10px;
        line-height: 18px;
        float: right;
    }
    .has-dropdown:hover>a .i-state-right:before {
        content: "\F105";
    }
}


/* Extension Mega Menu */

.mega-text {
    width: 34px;
    height: 34px;
    display: inline-block;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background: linear-gradient(225deg, #179ACB, #0A7197);
    font-size: 12px;
    font-weight: 600;
    line-height: 34px;
    text-align: center;
    cursor: pointer;
    color: #ffffff;
    border-radius: 5px;
}

.mega-text svg {
    fill: #fff;
    padding: 8px;
}

.mega-menu-list>ul>li>a {
    display: block;
    padding: 10px 22px;
    color: #000000;
    text-transform: uppercase;
    font-weight: 600;
    font-size: 12px;
}

.mega-menu-list>ul>li.js-active {
    background: linear-gradient(225deg, #179ACB, #0A7197);
    color: #ffffff;
}

.mega-menu-list>ul>li.js-active>a {
    color: #ffffff;
}

.mega-menu-content {
    display: none;
}

.mega-menu-content.js-active {
    display: block;
}

.mega-menu-content [class*="col-"]>ul>li>a {
    padding: 4px 0;
    display: block;
    color: #333333;
    font-size: 13px;
    transition: color 0.5s;
}

.mega-menu-content [class*="col-"]>ul>li>a:hover {
    color: #fa4400;
}

.mega-menu-content [class*="col-"]>ul>.mega-list-title>a {
    font-weight: 700;
}

.mega-menu-content>h5 {
    font-weight: 600;
    margin: 6px 0 0;
    font-size: 12px;
    color: #000000;
}

.kids-icon {
    margin-left: -4px;
}

@media (max-width: 1024px) {
    .toggle-mega-text {
        width: 34px;
        display: inline-block;
        height: 34px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        background-color: #1275C6;
        font-size: 12px;
        font-weight: 600;
        line-height: 34px;
        text-align: center;
        cursor: pointer;
        color: #ffffff;
        fill: #fff;
        padding: 7px;
        border-radius: 5px;
    }
    .mega-menu {
        display: none;
    }
    .mega-menu-list {
        padding: 20px;
        border: 1px solid #f6f6f6;
    }
    .mega-menu-list>ul>li {
        position: relative;
    }
    .mega-menu-content {
        padding: 20px;
    }
    .mega-menu-content .row {
        display: block;
    }
    .mega-menu-content [class*="col-"] {
        margin-bottom: 15px;
        max-width: 100%;
    }
    .mega-image {
        display: none;
    }
}

@media (min-width: 1025px) {
    .js-open.mega-text {
        -webkit-animation: mypulse 1s;
        animation: mypulse 1s;
    }
    .js-open.mega-text~.mega-menu {
        display: block;
    }
    .mega-menu {
        display: none;
        padding: 30px;
        width: 100%;
        background-color: #ffffff;
        box-shadow: 0 0 4px 0 rgba(0, 0, 0, 0.13);
        position: absolute;
        z-index: 998;
        top: 100%;
    }
    .mega-menu-wrap {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: nowrap;
        flex-wrap: nowrap;
    }
    .mega-menu-list {
        -ms-flex: 0 0 20%;
        flex: 0 0 20%;
        max-width: 20%;
    }
    .mega-menu-content {
        -ms-flex: 0 0 80%;
        flex: 0 0 80%;
        max-width: 80%;
        overflow-y: auto;
        padding: 0 17px;
        height: 370px;
        transition: opacity 0.5s;
        display: none;
    }
    .mega-menu-content::-webkit-scrollbar {
        width: 8px;
    }
    .mega-menu-content::-webkit-scrollbar-track {
        background: #eee;
    }
    .mega-menu-content::-webkit-scrollbar-thumb {
        background: #888;
    }
    .mega-menu-content::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
    .mega-banner {
        position: relative;
        overflow: hidden;
    }
    .mega-banner img {
        -webkit-transform: scale(1);
        transform: scale(1);
        transition: all 0.6s ease-in-out;
    }
    .mega-banner:hover img {
        -webkit-transform: scale(1.1);
        transform: scale(1.1);
    }
    .mega-image {
        margin: auto 0;
    }
}


/* Extension Mini Cart */

.mini-cart-shop-link {
    position: relative;
}

.mini-cart-shop-link>.total-item-round {
    top: 16px;
    left: 32px;
}

.total-item-round {
    width: 24px;
    position: absolute;
    height: 24px;
    line-height: 24px;
    border-radius: 50%;
    text-align: center;
    font-size: 11px;
    background-color: #fa4400;
    color: #ffffff;
}

.mini-cart {
    background-color: #ffffff;
    box-shadow: -2px 0px 5px 1px rgba(0, 0, 0, 0.06);
    width: 478px;
    padding: 14px;
    position: absolute;
    transition: all 0.3s ease;
    z-index: 998;
    top: 120%;
    opacity: 0;
    right: 0;
    visibility: hidden;
}

.mini-product-container {
    max-height: 280px;
    padding: 17px;
    overflow-y: auto;
}

.card-mini-product {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: nowrap;
    flex-wrap: nowrap;
    -ms-flex-align: center;
    align-items: center;
    -ms-flex-pack: justify;
    justify-content: space-between;
    background-color: #ffffff;
    border: 1px solid rgba(0, 0, 0, 0.08);
    padding: 15px;
    margin-bottom: 22px;
}

.card-mini-product:last-child {
    margin-bottom: 0;
}

.mini-product {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: center;
    align-items: center;
}

.mini-product__image-wrapper {
    margin-right: 20px;
}

.mini-product__link {
    background-color: #f5f5f5;
    display: inline-block;
    vertical-align: middle;
    width: 80px;
    height: 80px;
}

.mini-product__link img {
    display: block;
    min-width: 80px;
}

.mini-product__category {
    display: block;
}

.mini-product__category>a {
    color: #a0a0a0;
    transition: color 0.5s;
    font-size: 12px;
}

.mini-product__category>a:hover {
    color: #1275C6;
}

.mini-product__name {
    display: block;
}

.mini-product__name>a {
    color: #333333;
    font-size: 14px;
    font-weight: 600;
    transition: color 0.5s;
}

.mini-product__name>a:hover {
    color: #1275C6;
}

.mini-product__quantity {
    font-size: 12px;
    margin-right: 4px;
    color: #333333;
}

.mini-product__price {
    font-size: 14px;
    font-weight: 600;
    color: #333333;
}

.mini-product__delete-link {
    padding: 10px;
    font-size: 16px;
    display: inline-block;
    color: #333333;
    transition: color 0.5s;
}

.mini-product__delete-link:hover {
    color: #1275C6;
}

.mini-total {
    margin-bottom: 16px;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: nowrap;
    flex-wrap: nowrap;
    -ms-flex-pack: justify;
    justify-content: space-between;
    -ms-flex-align: center;
    align-items: center;
}

.subtotal-text {
    display: block;
    font-size: 14px;
    font-weight: 600;
    color: #333333;
}

.subtotal-value {
    display: block;
    font-size: 14px;
    font-weight: 700;
    color: #333333;
}

.mini-link {
    display: block;
    text-align: center;
    padding: 12px 42px;
    border-radius: 6px;
    margin-bottom: 20px;
    font-weight: 700;
    font-size: 10px;
}

.mini-action {
    width: 65%;
    margin: 0 auto;
}

@media (max-width: 1024px) {
    .mini-cart-shop-link>.total-item-round {
        top: 5px;
        left: 38px;
    }
    .toggle-button-shop+.total-item-round {
        top: 5px;
        right: 10px;
    }
    .has-dropdown>.mini-cart {
        width: 100% !important;
        box-shadow: none;
        transition: none;
        padding: 14px;
        position: static;
        opacity: 1;
        visibility: visible;
        display: none;
    }
    .mini-product-container {
        max-height: 836px;
    }
    .card-mini-product {
        display: block;
        text-align: center;
    }
    .mini-product {
        display: block;
    }
    .mini-product__image-wrapper {
        margin-right: 0;
        margin-bottom: 10px;
    }
    .mini-product__info-wrapper {
        padding: 0;
        display: block;
        margin-bottom: 10px;
    }
    .mini-total {
        margin-bottom: 22px;
    }
}

@media (min-width: 1025px) {
    .toggle-button-shop+.total-item-round {
        display: none;
    }
    .has-dropdown:hover>.mini-cart {
        top: 100%;
        opacity: 1;
        visibility: visible;
    }
}


/*--------------------------------------------------------------
20.3 Owl-Carousel
--------------------------------------------------------------*/

.slider-fouc {
    display: none;
}

.s-skeleton {
    position: relative;
}

.s-skeleton--h-600 {
    min-height: 360px;
    border-radius: 20px;
}

.s-skeleton--h-640 {
    min-height: 640px;
}

.s-skeleton--bg-grey {
    background-color: #f5f5f5;
}

.s-skeleton--bg-black {
    background-color: #000000;
}

.s-skeleton .owl-carousel {
    position: static;
}

.primary-style-1 .hero-slide {
    height: 360px;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: center;
    align-items: center;
    border-radius: 20px;
}

.primary-style-2 .hero-slide {
    height: 600px;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: center;
    align-items: center;
}

.primary-style-3 .hero-slide {
    height: 640px;
}

.primary-style-3-wrap {
    position: absolute;
    bottom: 120px;
    z-index: 1;
    width: 100%;
}

.hero-slide {
    background: center center/cover no-repeat;
}

.hero-slide--1 {
    background-image: url(../images/slider/slider1.jpg);
}

.hero-slide--2 {
    background-image: url(../images/slider/slider2.jpg);
}

.hero-slide--3 {
    background-image: url(../images/slider/slider3.jpg);
}

.hero-slide--4 {
    background-image: url(../images/slider/slider1.jpg);
}

.hero-slide--5 {
    background-image: url(../images/slider/slider1.jpg);
}

.hero-slide--6 {
    background-image: url(../images/slider/slider1.jpg);
}

.hero-slide--7 {
    background-image: url(../images/slider/slider1.jpg);
}

.hero-slide--8 {
    background-image: url(../images/slider/slider1.jpg);
}

.hero-slide--9 {
    background-image: url(../images/slider/slider1.jpg);
}

.owl-carousel .owl-dots {
    position: absolute;
}

.owl-carousel button.owl-dot:focus {
    outline: 0;
}

.owl-carousel.primary-style-1 .owl-dots {
    top: 56%;
    -webkit-transform: translateY(-50%);
    transform: translateY(-50%);
    right: 40px;
}

.owl-carousel.primary-style-1 button.owl-dot {
    width: 14px;
    height: 14px;
    border-radius: 50%;
    display: block;
    margin-bottom: 6px;
    background: #e1e1e1;
    transition: background 0.8s ease-out;
}

.owl-carousel.primary-style-1 button.owl-dot:last-child {
    margin-bottom: 0;
}

.owl-carousel.primary-style-1 button.owl-dot.active,
.owl-carousel.primary-style-1 button.owl-dot:hover {
    background: transparent linear-gradient(225deg, #179ACB, #0A7197);
}

.owl-carousel.primary-style-2 .owl-dots {
    width: 100%;
    text-align: center;
    bottom: 20px;
}

.owl-carousel.primary-style-2 button.owl-dot {
    width: 11px;
    height: 11px;
    display: inline-block;
    margin-right: 4px;
    border-radius: 50%;
    background-color: #7f7f7f;
    transition: background 0.8s ease-out;
}

.owl-carousel.primary-style-2 button.owl-dot:last-child {
    margin-right: 0;
}

.owl-carousel.primary-style-2 button.owl-dot.active,
.owl-carousel.primary-style-2 button.owl-dot:hover {
    background-color: #ffffff;
}

.primary-style-2-container {
    width: 100%;
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto;
}

@media (min-width: 576px) {
    .primary-style-2-container {
        max-width: 540px;
    }
}

@media (min-width: 768px) {
    .primary-style-2-container {
        max-width: 720px;
    }
}

@media (min-width: 992px) {
    .primary-style-2-container {
        max-width: 960px;
    }
}

.owl-carousel.primary-style-3 .owl-dots {
    top: 50%;
    -webkit-transform: translateY(-50%);
    transform: translateY(-50%);
    right: 40px;
}

.owl-carousel.primary-style-3 button.owl-dot {
    width: 5px;
    height: 32px;
    display: block;
    margin-bottom: 6px;
    background-color: #f3f3f3;
    transition: background 0.8s ease-out;
}

.owl-carousel.primary-style-3 button.owl-dot:last-child {
    margin-bottom: 0;
}

.owl-carousel.primary-style-3 button.owl-dot.active,
.owl-carousel.primary-style-3 button.owl-dot:hover {
    background-color: #1275C6;
}

.owl-carousel#testimonial-slider .owl-dots {
    width: 100%;
    text-align: center;
    bottom: -30px;
}

.owl-carousel#testimonial-slider button.owl-dot {
    width: 11px;
    height: 11px;
    display: inline-block;
    border: 1px solid #333333;
    margin-right: 4px;
    border-radius: 50%;
    background-color: transparent;
    transition: background 0.8s ease-out;
}

.owl-carousel#testimonial-slider button.owl-dot:last-child {
    margin-right: 0;
}

.owl-carousel#testimonial-slider button.owl-dot.active,
.owl-carousel#testimonial-slider button.owl-dot:hover {
    background-color: #333333;
}

.content-span-1 {
    font-size: 1.25rem;
    font-weight: 700;
    display: block;
}

.content-span-2 {
    font-weight: 700;
    font-size: 3.25rem;
    display: block;
}

.content-span-3 {
    display: block;
    font-size: 0.875rem;
    margin-bottom: 8px;
}

.content-span-4 {
    display: block;
    font-weight: 600;
    font-size: 0.875rem;
    margin-bottom: 20px;
}

.content-span-4 span {
    font-weight: 700;
    margin-left: 4px;
    font-size: 1.375rem;
}

.shop-now-link {
    padding: 18px 53px;
    font-size: 0.75rem;
    position: relative;
    transition: background 0.3s;
    text-align: center;
    border-radius: 6px;
    display: inline-block;
}

.slider-content {
    padding: 30px;
}

.owl-item .slider-content--animation * {
    -webkit-animation-duration: 1s;
    animation-duration: 1s;
    -webkit-animation-fill-mode: both;
    animation-fill-mode: both;
}

.owl-item.active .content-span-1 {
    -webkit-animation-delay: 0.5s;
    animation-delay: 0.5s;
    -webkit-animation-name: fadeInLeft;
    animation-name: fadeInLeft;
}

.owl-item.active .content-span-2 {
    -webkit-animation-delay: 1s;
    animation-delay: 1s;
    -webkit-animation-name: fadeInLeft;
    animation-name: fadeInLeft;
}

.owl-item.active .content-span-3 {
    -webkit-animation-delay: 1.5s;
    animation-delay: 1.5s;
    -webkit-animation-name: fadeInLeft;
    animation-name: fadeInLeft;
}

.owl-item.active .content-span-4 {
    -webkit-animation-delay: 1.5s;
    animation-delay: 1.5s;
    -webkit-animation-name: fadeInLeft;
    animation-name: fadeInLeft;
}

.owl-item.active .shop-now-link {
    -webkit-animation-delay: 2s;
    animation-delay: 2s;
    -webkit-animation-name: fadeInLeft;
    animation-name: fadeInLeft;
}

.product-slider,
.tab-slider {
    position: static;
}

.product-slider .owl-item:hover,
.tab-slider .owl-item:hover {
    z-index: 2;
}


/* Products-Slider (Previous & Next Buttons) */

.section__content:hover .p-prev,
.section__content:hover .t-prev,
.section__content:hover .p-next,
.section__content:hover .t-next {
    opacity: 1;
}

.p-prev,
.p-next {
    text-align: center;
    box-shadow: 0 6px 15px 5px rgba(36, 37, 38, 0.08);
    z-index: 1;
    cursor: pointer;
    display: inline-block;
    position: absolute;
    top: 0;
    bottom: 0;
    height: 72px;
    line-height: 72px;
    width: 36px;
    background-color: #ffffff;
    margin: auto 0;
    transition: opacity .6s ease-in, background-color .6s ease-in;
    opacity: 0;
}

.p-prev>i,
.p-next>i {
    font-size: 14px;
    color: #333333;
    display: block;
    position: absolute;
    top: 50%;
    -webkit-transform: translateY(-50%);
    transform: translateY(-50%);
}

.p-prev {
    left: 0;
    border-bottom-right-radius: 90px;
    border-top-right-radius: 90px;
}

.p-prev>i {
    left: 80px;
}

.p-next {
    right: 0;
    border-bottom-left-radius: 90px;
    border-top-left-radius: 90px;
}

.p-next>i {
    right: 80px;
}

.t-prev,
.t-next {
    text-align: center;
    z-index: 1;
    display: inline-block;
    box-shadow: 0 6px 15px 5px rgba(36, 37, 38, 0.08);
    background-color: #ffffff;
    position: absolute;
    top: 0;
    bottom: 0;
    cursor: pointer;
    height: 36px;
    line-height: 36px;
    width: 36px;
    margin: auto 0;
    transition: opacity .6s ease-in;
    opacity: 0;
}

.t-prev>i,
.t-next>i {
    font-size: 14px;
    color: #333333;
    display: block;
    position: absolute;
    top: 50%;
    -webkit-transform: translateY(-50%);
    transform: translateY(-50%);
}

.t-prev {
    left: 0;
    border-bottom-right-radius: 90px;
    border-top-right-radius: 90px;
}

.t-prev>i {
    left: 10px;
}

.t-next {
    right: 0;
    border-bottom-left-radius: 90px;
    border-top-left-radius: 90px;
}

.t-next>i {
    right: 10px;
}

#brand-slider .owl-stage {
    margin: 1.25rem 0;
}

.brand-slide {
    width: 155px;
    height: 60px;
    margin: 0 auto;
}

.brand-slide a {
    background-color: #ffffff;
}

.brand-slide a:hover {
    box-shadow: 2px 3px 8px 0 rgba(0, 0, 0, 0.2);
}

.b-prev,
.b-next {
    text-align: center;
    z-index: 1;
    display: inline-block;
    position: absolute;
    top: 0;
    cursor: pointer;
    bottom: 0;
    height: 36px;
    line-height: 36px;
    width: 36px;
    box-shadow: 0 6px 15px 5px rgba(36, 37, 38, 0.08);
    background-color: #ffffff;
    margin: auto 0;
    transition: opacity .6s ease-in;
    opacity: 0;
}

.b-prev>i,
.b-next>i {
    font-size: 14px;
    color: #333333;
}

.b-prev {
    left: 0;
}

.b-next {
    right: 0;
}


/* Brand-Slider (Previous & Next Buttons) */

.section__content:hover .b-prev,
.section__content:hover .b-next {
    opacity: 1;
}


/*--------------------------------------------------------------
20.4 jquery.scrollUp
--------------------------------------------------------------*/


/* ScrollUp Custom */

#topScroll {
    right: 24px;
    bottom: 60px;
    width: 50px;
    height: 50px;
    line-height: 50px;
    box-shadow: 2px 2px 4px 4px rgba(36, 37, 38, 0.08);
    background-color: #ffffff;
    color: #333333;
    font-size: 18px;
    text-align: center;
    border-radius: 30px;
}


/*--------------------------------------------------------------
20.5 Slick Carousel
--------------------------------------------------------------*/

.slick-slide,
.slick-slide * {
    outline: none;
}

#pd-o-thumbnail .slick-slide:not(.slick-current) {
    opacity: .4;
}

#js-product-detail-modal-thumbnail .slick-slide:not(.slick-current) {
    opacity: .4;
}

.pt-prev,
.pt-next {
    text-align: center;
    z-index: 1;
    display: inline-block;
    position: absolute;
    top: 0;
    cursor: pointer;
    bottom: 0;
    border-radius: 50%;
    height: 36px;
    line-height: 36px;
    width: 36px;
    margin: auto 0;
    transition: opacity ease-in-out .5s, background-color ease-in 0.3s;
    background-color: #ffffff;
    opacity: 0;
}

.pt-prev i,
.pt-next i {
    font-size: 12px;
    color: #000000;
}

.pt-prev {
    left: 20px;
}

.pt-next {
    right: 20px;
}

#pd-o-thumbnail:hover .pt-prev,
#pd-o-thumbnail:hover .pt-next {
    opacity: .8;
}

#js-product-detail-modal-thumbnail:hover .pt-prev,
#js-product-detail-modal-thumbnail:hover .pt-next {
    opacity: .8;
}


/*--------------------------=========================== custom css ============================--------------------------------------*/

.section__span {
    font-size: 14px;
}

.aspect img {
    border-radius: 20px;
}

.promotion:before {
    border-radius: 20px;
}

.aspect--square {
    border-radius: 20px;
}

.get-part .promotion {
    border-radius: 20px;
}

.is-grid-active .product-m:hover {
    box-shadow: 0 0 15px 0 rgba(0, 0, 0, 0.2);
    border-radius: 20px 20px 0px 0px;
}
