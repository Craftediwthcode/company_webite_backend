Ladda.bind(".ladda-button", {
  timeout: 2e3
}), Ladda.bind(".progress-demo .ladda-button", {
  callback: function(a) {
    var t = 0,
      d = setInterval(function() {
        (t = Math.min(
          t + 0.1 * Math.random(),
          1
        )), a.setProgress(t), 1 === t && (a.stop(), clearInterval(d));
      }, 200);
  }
});
