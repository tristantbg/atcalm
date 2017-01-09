<?php if(!defined('KIRBY')) exit ?>

title: Project
pages: false
files: true
fields:
  prevnext: prevnext
  title:
    label: Title
    type:  text
    width: 1/2
  date:
    label: Year
    type:  date
    format: YYYY
    width: 1/2
    required: true
  subtitle:
    label: Subtitle
    type:  text
    width: 1/2
  featured:
    label: Featured image
    type: image
    width: 1/2
    help: Required to display project
  text:
    label: Description
    type: textarea
  medias:
    label: Medias
    type: builder
    fieldsets:
      image:
        label: Image
        entry: >
               <table style="width:100%; font-size: 11px">
               <tr>
               <td style="width:20%">Image</td>
               <td>Width</td>
               <td>Position</td>
               <td>Offset</td>
               <td>Caption</td>
               </tr>
               <tr>
               <td style="width:20%"><img src="{{_thumb}}" width="80px"><br>{{content}}</td>
               <td>{{width}}</td>
               <td>{{position}}</td>
                <td>{{yoffset}}</td>
               <td>{{caption}}</td>
               </tr>
               </table>
        fields:
          content:
            label: Image
            type: image
            required: true
          width:
            label: Width
            type: number
            min: 1
            max: 4
            width: 1/3
            required: true
            default: 2
          position:
            label: Position
            type: select
            width: 1/3
            required: true
            options:
              left : Left
              midleft : Mid-Left
              center : Center
              midright : Mid-Right
              right : Right
            default: center
          yoffset:
            label: Y Offset
            type: number
            width: 1/3
            default: 0
          caption:
            label: Caption
            type: text
      video:
        label: Video
        entry: >
               <table style="width:100%; font-size: 11px">
               <tr>
               <td>URL</td>
               <td>Width</td>
               <td>Position</td>
               <td>Offset</td>
               <td>Caption</td>
               </tr>
               <tr>
               <td>{{link}}</td>
               <td>{{width}}</td>
               <td>{{position}}</td>
                <td>{{yoffset}}</td>
               <td>{{caption}}</td>
               </tr>
               </table>
        fields:
          link:
            label: URL Vimeo or Youtube
            type: url
            required: true
          width:
            label: Width
            type: number
            min: 1
            max: 4
            width: 1/3
            required: true
            default: 2
          position:
            label: Position
            type: select
            width: 1/3
            required: true
            options:
              left : Left
              midleft : Mid-Left
              center : Center
              midright : Mid-Right
              right : Right
            default: center
          yoffset:
            label: Y Offset
            type: number
            min: 0
            max: 100
            width: 1/3
            default: 0
          caption:
            label: Caption
            type: text