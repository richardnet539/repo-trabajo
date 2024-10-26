// postcss.config.js
module.exports = {
    plugins: [
      require('cssnano')({
        preset: ['default', {
          discardComments: { removeAll: true },          // Remove all comments
          mergeRules: true,                              // Merge duplicate selectors
          reduceIdents: { keyframes: false },            // Reduce identifier names (like keyframes)
          discardUnused: true,                           // Remove unused keyframes and other rules
          minifyFontValues: true,                        // Minify font declarations
          normalizeWhitespace: true,                     // Normalize whitespace across rules
          convertValues: { length: false },              // Convert values to shorter representations
          reduceTransforms: true,                        // Simplify CSS transforms
          colormin: true,                                // Minimize colors (e.g., #ff0000 to red)
          minifySelectors: true,                         // Minify selector names
          discardOverridden: true,                       // Remove overridden properties in rules
          zindex: false,                                 // Don't optimize z-index (optional, for layered elements)
          svgo: {                                        // Optimize SVG if any inline SVGs are present
            plugins: [
              { removeTitle: true },
              { convertPathData: true }
            ]
          }
        }],
      }),
    ],
  };
  