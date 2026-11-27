# LODD Homepage – WordPress Theme

This is my submission for the GTECH WordPress Developer (Arabic) assessment. It's a custom theme called **LODD**. It rebuilds the Figma homepage in English and Arabic, and every piece of content can be edited from the WordPress admin with ACF.

Once the site is running:

- English homepage: `/`
- Arabic homepage: `/ar/`
- Admin: `/wp-admin/` (login details are in my email)

## Plugins you'll need

Both are free and available on wordpress.org:

- **Advanced Custom Fields**: holds all the homepage content.
- **Polylang**: handles the English/Arabic versions, the `/ar/` URLs and the language switcher.

No page builder and no ACF Pro.

## Installation

1. Create an empty WordPress site (I used Local, PHP 8.2).
2. Replace its `wp-content` folder with the one inside `lodd-site-backup.zip`.
3. Import `database.sql`.
4. Point the site at your own URL. The backup was made on my local machine, so run `wp search-replace 'http://gtech.local' 'http://your-site-url'`.
5. Go to Settings → Permalinks and click Save, so the `/ar/` URLs work.
6. Log in and you're done.

## Editing content

- **Pages → Home** (English) and **Pages → الرئيسية** (Arabic) each have one tab per homepage section, such as Hero, About and Careers.
- **Solutions**, **Technologies** and **Sectors** each have their own admin menu, because they're repeating cards. You add, remove or reorder them there. The "Order" field controls the sequence.
- Menus are under Appearance → Menus, with one set per language.

## Assumptions I made

- **Responsive design.** Figma only has the desktop layout, so I designed the tablet and mobile versions myself, keeping the same structure and spacing.
- **Technologies section.** Figma only includes text and an image for *Command & Control*. I wrote the text for the other three tabs and reused images from elsewhere in the design. These are placeholders.
- **Hero video.** I took it from the Figma prototype and converted it to MP4.
- **Links.** All navigation, buttons, footer links and social icons are placeholders. They're either in-page anchors or the networks' home pages.
- **Language switcher.** It isn't in the design. I added it next to "Contact us" and styled it like the menu links.
- **Footer logo.** WordPress doesn't allow SVG uploads, so the footer logo comes from the theme files. You can replace it with a PNG from the admin.
- **Section dividers.** The lines are drawn in CSS so they resize with the page. The drone animation follows the timing in the Figma prototype.
- **Repeating cards.** Free ACF has no "repeater" field, which is why the cards are separate post types instead.

## AI tools I used

I used **Claude Code** (Anthropic) as a coding assistant, connected to Figma through the Figma MCP. I used it for:

- **Reading the design:** pulling exact measurements, colours, fonts and spacing from the Figma file, and exporting the images and icons.
- **Writing and refactoring code:** speeding up the templates, ACF field setup, CSS and JavaScript, which I then reviewed and adjusted.
- **Arabic copy:** drafting the translation, which I proofread and edited.
- **Checking the build:** comparing screenshots and measurements of the site against the Figma frames.

The architecture, the choice of plugins, how content is structured for editors, and the final review and testing were my own decisions. I checked the result in the browser in both languages and on different screen sizes, and asked for changes where it didn't match the design. One example is the divider animation, which I had reworked to loop like the prototype instead of reacting to scroll.
