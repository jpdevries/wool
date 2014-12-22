wool
====

Typographic crime-stopping snippet for MODX 2.x.

> “Any man who would letterspace blackletter would shag sheep.” — Frederic Goudy

Stop stealing sheep & make your clients look like they know how type works with this typographic crime-stopping snippet for MODX 2.x.

## Support
White wool is currently packaged specifically for MODX Revolution, it's written in RegEx meaning it should be fairly portable to other technologies.

## Overview
Wool helps you keep your client's poor HTML practices from being reflected to the world by identifying and correcting them.  

Currently Wool is capable of bailing your clients out of all [10 HTML entity crimes you really shouldn't commit](http://line25.com/articles/10-html-entity-crimes-you-really-shouldnt-commit) free of&nbsp;charge.

Wool does this by performing clever Regular Expressions on provided `$input` text and returning more typographically correct&nbsp;result.

## Options

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
fixCrazyExclamations  | Removes consequtive exclamation points!!! | `false`
fixCrazyQuestionMarks  | Removes consequtive exclamation question marks??? | `false`
