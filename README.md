# vue

This template should help get you started developing with Vue 3 in Vite.

## Recommended IDE Setup

[VSCode](https://code.visualstudio.com/) + [Volar](https://marketplace.visualstudio.com/items?itemName=johnsoncodehk.volar) (and disable Vetur).

## Type Support for `.vue` Imports in TS

Since TypeScript cannot handle type information for `.vue` imports, they are shimmed to be a generic Vue component type by default. In most cases this is fine if you don't really care about component prop types outside of templates.

However, if you wish to get actual prop types in `.vue` imports (for example to get props validation when using manual `h(...)` calls), you can run `Volar: Switch TS Plugin on/off` from VSCode command palette.

## Customize configuration

See [Vite Configuration Reference](https://vitejs.dev/config/).

## Project Setup

```sh
npm install
```

### Compile and Hot-Reload for Development

```sh
npm run dev
```

### Type-Check, Compile and Minify for Production

```sh
npm run build
```

# ==============================

## Xampp DNS Setup
- go to `C:\xampp\apache\conf\extra` and add the following lines here on 'httpd-vhosts.conf'

```
<VirtualHost *:80>
 ServerName www.cghris-new.test
 ServerAlias cghris-new.test
 DocumentRoot C:/xampp/htdocs/cghris-new/public
</VirtualHost>
```

- Windows start menu >> Type/ Search for "Notepad" >> Right click >> Run as Administrator
- File >> Open >> and go to `C:\Windows\System32\drivers\etc`
- Show file type - All Files (*.*)
- Open "hosts"
- Add the line, save and close Notepad - `127.0.0.5      cghris-new.test`

- Restart Xampp
