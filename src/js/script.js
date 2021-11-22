export const init = async () => {
  console.log(`start executing this JavaScript`);
  const data = await fetch(`https://api.themoviedb.org/3/search/tv?api_key=662c8478635d4f25ee66abbe201e121d&query=office`);
  const response = await data.json();
  console.log(response);
};
