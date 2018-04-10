function showel(el) {
if ($(el).closest("li").find("ul").css("display")=="none") {
  $(el).closest("li").find("ul").show("slow");
} 
else {
 $(el).closest("li").find("ul").hide("fast");
}
}