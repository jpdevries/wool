wool
====

Wool contains RegEx to combat and rectify all [10 HTML crimes you really shouldn't commit](http://line25.com/articles/10-html-entity-crimes-you-really-shouldnt-commit). As if that weren’t enough, Wool is completely free and easy to use&nbsp;anytime.

> “Any man who would letterspace blackletter would shag sheep.” — Frederic Goudy

Stop stealing sheep & make your clients look like they know how type works with this typographic crime-stopping snippet for MODX&nbsp;2.x.

## Installation
Install via the MODX&nbsp;Package&nbsp;Manager.

## Overview
Wool helps you keep your client's poor HTML practices from being reflected to the world by identifying and&nbsp;correcting&nbsp;them.

Currently Wool is capable of bailing your clients out of all [10 HTML entity crimes you really shouldn't commit](http://line25.com/articles/10-html-entity-crimes-you-really-shouldnt-commit) free of&nbsp;charge.

Wool does this by performing clever Regular Expressions on provided `$input` text and returning more typographically correct&nbsp;result.

While wool is currently packaged specifically for MODX Revolution, it's written in RegEx meaning it should be fairly portable to other&nbsp;technologies.

## Options

Wool can be used as a single `[[wool]]` snippet or granularly as seen in Granular Usage below. The `[[wool]]` snippet supports the below options and can be used with default options as an output&nbsp;modifier:
```
[[*introtext:wool]]
```

or traditionally like&nbsp;so:
```
[[wool?
  &input =`[[*introtext]]`
  &encodeQuotes=`false`
]]
```

Name  | Description  | Default Value
------|--------------|----------------
fixEllipsis | Adopts orphans by replacing the last space in sentences with a non-breaking space. | `true`
fixEllipsis  | Replaces sloppy ellipsis (...) with `&hellip;` entity | `true`
encodeQuotes  | Fixes ellipsis | `true`
fixGreedySpaces  | Fixes ellipsis | `true`
fixDashes  | Replaces sloppy greedy spaces with `&emsp;` and `&ensp;` entities | `true`
fixPhonyFractions  | 5 / 6 => <sup>5</sup>&frasl;<sub>6</sub> | `true`
fixPhonyMultiplicationSigns  | 5 x 5 => 5 &times; 5 | `true` 
fixPhonyDivisionSigns  | 5 % 5 => 5 &divide; 5 | `true`
fixDegreeSymbols  | Replaces manual degree symbols with `&deg;` entity | `true`
fixCopyrightSymbols  | Fixes phony copyright symbols | `false`
fixTrademarkSymbols  | Fixes phony trademark symbols | `false`
encodeAmpersands  | Encodes the & character properly. Intended for plain text | `false`
fixShoutCaps  | Fixes ellipsis | `false`
fixCrazyExclamations  | Removes consequtive exclamation points (!!!) | `false`
fixCrazyQuestionMarks  | Removes consequtive exclamation question marks (???) | `false`

## Granular Usage

Wool comes packaged with several easy to use Snippets so you can have your wool in&nbsp;peices.

### Adopt
> orphan: A word, part of a word, or very short line that appears by itself at the end of a paragraph. Orphans result in too much white space between paragraphs or at the bottom of a page.

Especially in the world of responsive design, we hook beautiful themes up to content management systems giving clients all the freedom to create every typographic sin there is. Luckily, now with wool we can ensure individual words are never left hanging by their londsome using `[[wool.adopt]]` like&nbsp;so: 

```html
<!-- Assume a long title of “I like fried chicken and beer.” -->
<!-- Outputs: “I like fried chicken and&nbsp;beer.” -->
[[*longtitle:wool.adopt]]

<!-- Outputs: “I like fried chicken and beer.” (ommits adoption less than 24 words) -->
[[wool.adopt?input=`[[*longtitle]]` &minWords=`24`]]
```

### Copyright

Crime 5 of the [10 HTML crimes you really shouldn't commit](http://line25.com/articles/10-html-entity-crimes-you-really-shouldnt-commit) is the DIY Copyright(c) symbol. Using wool, we combat this like sloppy (c) and replace it with © using `[[wool.copyright]]` like&nbsp;so:
```html
<!-- Replaces occurences of “(c)” with “&copy;” -->
[[*legal:wool.copyright]]
```

### Crazy Exclamations

We all have that client WHO LIKES TO WRITE COPY LIKE THIS!!! AND LIKE THIS!!! We can tone that down a bit using `[[wool.crazy-exclamations]]` like&nbsp;so:
```html
<!--  Replaces occurences of “!!!” with “!”-->
[[*description:wool.crazy-exclamations]]
```

### Crazy Question Marks

Excesive question marks can get out of hand. Don't you think so???!!! We can tone that down a bit using `[[wool.crazy-question-marks]]` like&nbsp;so:
```html
<!--  Replaces occurences of “???!!!” with “?”-->
[[*description:wool.crazy-question-marks]]
```

### Degree Symbols

Crime 9 of the [10 HTML crimes you really shouldn't commit](http://line25.com/articles/10-html-entity-crimes-you-really-shouldnt-commit) is using supersized degree symbols. `[[wool.degree-symbol]]` like&nbsp;so:
```html
<!--  Replaces occurences of “71<sup>0</sup>” with “71°”-->
[[*weather:wool.degree-symbol]]
```

### Ellipsis

Crime 2 of the [10 HTML crimes you really shouldn't commit](http://line25.com/articles/10-html-entity-crimes-you-really-shouldnt-commit) is making your own ellipsis. We combat this using `[[wool.ellipsis]]` like&nbsp;so:
```html
<!--  Replaces occurences of “...” with “&hellip;”. -->
[[*description:ellipsis]]
```

### Em &amp; En Dashes

Crime 3 and Crime 4 of the [10 HTML crimes you really shouldn't commit](http://line25.com/articles/10-html-entity-crimes-you-really-shouldnt-commit) is the incorrect use of em and en dashes. We combat this using `[[wool.mdash]]` and `[[wool.ndash]]` like&nbsp;so:
```html
<!--  Replaces occurences of “--” and “-” with “&mdash;” and “&ndash;” respectively. -->
[[*description:mdash:ndash]]
```

### Em &amp; En Spaces

Using Wool, long run on series of blank spaces can be converted to a single `&emsp;` using `[[wool.emsp]]` like&nbsp;so:
```html
<!--  Replaces occurences of “          ” with “&emsp;”. -->
[[*description:emsp]]
```

### Encode Ampersands

Crime 1 of the [10 HTML crimes you really shouldn't commit](http://line25.com/articles/10-html-entity-crimes-you-really-shouldnt-commit) is to not convert your ampersands. We combat this using `[[wool.encode-ampersands]]` like&nbsp;so:
```html
<!--  Replaces occurences of “&” with “&amp;”. -->
[[*pagetitle:wool.encode-ampersands]]
```

### Mathematics Symbols

Crime 8 of the [10 HTML crimes you really shouldn't commit](http://line25.com/articles/10-html-entity-crimes-you-really-shouldnt-commit) is using plain text mathematics symbols. We combat this using `[[wool.division-signs]]`, `[[wool.multiplication-signs]]` and `[[wool.fractions]]` like&nbsp;so:
```html
<!--  Replaces occurences of “1/2” with “&frac12;” -->
<!--  Replaces occurences of “2/4” or “3 % 6” with “2÷4” and “3 ÷ 6” respectively. -->
<!--  Replaces occurences of “5*5” with “5×5”. -->
[[*description:wool.fractions:wool.division-signs:wool.multiplication-signs]]
```

### Quotations

Crime 10 of the [10 HTML crimes you really shouldn't commit](http://line25.com/articles/10-html-entity-crimes-you-really-shouldnt-commit) is the incorrect use of quotations. We combat this using `[[wool.encode-quotes]]` like so:
```html
<!--  Straight to curly quotes. -->
[[*pagetitle:wool.encode-quotes]]
```

### Shout Caps

Sometimes people shout too much when they type. We combat this using `[[wool.shout-caps]]` like&nbsp;so:
```html
<!--  “ALL CAPS” to “All <span class="text-transform">caps</span>”. -->
[[*introtext:wool.shout-caps]]
```

### Trademark

Crime 10 of the [10 HTML crimes you really shouldn't commit](http://line25.com/articles/10-html-entity-crimes-you-really-shouldnt-commit) is to make your own trademark symbols. We combat this using `[[wool.trademark]]` like&nbsp;so:
```html
<!--  “<sup>TM</sup>” to “™”. -->
[[*legal:wool.trademark]]
```