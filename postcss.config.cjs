// import postcssImport from 'postcss-import';
// import tailwindPostcss from '@tailwindcss/postcss';
// import autoprefixer from 'autoprefixer';

// export default {
//   plugins: [
//     postcssImport,
//     tailwindPostcss,
//     autoprefixer,
//   ],
// };


module.exports = {
  plugins: [
    require('postcss-import'),
    require('@tailwindcss/postcss'),
    require('autoprefixer'),
  ],
};
