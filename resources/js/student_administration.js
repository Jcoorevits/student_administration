let Student_Administration = (function () {

    function hello() {
        console.log('The Vinyl Shop JavaScript works! 🙂');
    }

    return {
        hello: hello    // publicly available as: VinylShop.hello()
    };
})();

export default Student_Administration;
