# Filter Plus - Gutenberg Block Development

## Development Setup

### Prerequisites
- Node.js (v16 or higher)
- npm or yarn

### Installation

1. Navigate to the plugin directory:
```bash
cd /Applications/MAMP/htdocs/wordpress/wp-content/plugins/filter-plus
```

2. Install dependencies:
```bash
npm install
```

### Development Workflow

#### Development Mode (with hot reload)
To start development with auto-compilation on file changes:
```bash
npm start
```
or
```bash
npm run dev
```

This will watch your `src/` files and automatically rebuild to `build/index.js` when you make changes.

#### Production Build
To create an optimized production build:
```bash
npm run build
```

### Project Structure

```
filter-plus/
├── src/                          # Source files (for development)
│   ├── index.js                  # Main entry point
│   └── blocks/
│       ├── woo-filter/
│       │   └── index.js          # WooCommerce Filter Block
│       └── wp-filter/
│           └── index.js          # WordPress Content Filter Block
├── build/                        # Compiled files (generated)
│   └── index.js                  # Built bundle (DO NOT EDIT)
├── core/
│   └── widgets/
│       └── gutenburg-block/
│           ├── init.php          # Block registration
│           └── blocks/
│               ├── woo-filter.php    # Server-side rendering
│               └── wp-filter.php     # Server-side rendering
├── package.json                  # Dependencies
└── .wp-env.json                  # WordPress environment config
```

### Block Development

#### WooCommerce Product Filter Block
- **Location**: `src/blocks/woo-filter/index.js`
- **Server-side**: `core/widgets/gutenburg-block/blocks/woo-filter.php`
- **Block Name**: `filter-plus/woo-filter`

#### WordPress Content Filter Block
- **Location**: `src/blocks/wp-filter/index.js`
- **Server-side**: `core/widgets/gutenburg-block/blocks/wp-filter.php`
- **Block Name**: `filter-plus/wp-filter`

### Important Notes

1. **Never edit `build/index.js` directly** - Always edit files in `src/` folder
2. **Server-side rendering** - Both blocks use server-side rendering (save function returns null)
3. **PHP callbacks** - Block rendering is handled by PHP callbacks in `core/widgets/gutenburg-block/blocks/`
4. **Localized data** - Block editor has access to `window.filterPlus` object with categories, tags, attributes, etc.

### Making Changes

1. Edit files in `src/blocks/` directory
2. If `npm start` is running, changes will auto-compile
3. Refresh WordPress admin to see changes
4. Build for production with `npm run build` before committing

### Available Scripts

- `npm start` - Start development mode with watch
- `npm run dev` - Alias for npm start
- `npm run build` - Build for production

### WordPress Scripts

This project uses `@wordpress/scripts` which provides:
- Webpack configuration
- Babel transpilation
- Hot module replacement
- Production optimization
- And more...

See [@wordpress/scripts documentation](https://developer.wordpress.org/block-editor/reference-guides/packages/packages-scripts/) for more details.
