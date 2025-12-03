document.getElementById("seeMembers").addEventListener("click", () => {
  document.getElementById("welcome").style.display = "none";
  const members = document.getElementById("members");
  members.style.display = "block";
  members.classList.add("fade-in");
});

document.getElementById("backBtn").addEventListener("click", () => {
  document.getElementById("members").style.display = "none";
  const welcome = document.getElementById("welcome");
  welcome.style.display = "block";
  welcome.classList.add("fade-in");
});
