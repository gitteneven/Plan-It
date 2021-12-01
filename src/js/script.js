

let timeoutID;

const handleInputField = () => {
  clearTimeout(timeoutID);
  timeoutID = setTimeout(() => {
    submitWithJS();
  }, 500);
};

const submitWithJS = async () => {
  const $form = document.querySelector('.filter-form');
  const data = new FormData($form);
  const entries = [...data.entries()];
  console.log('entries:', entries);
  const qs = entries[1][1];
  console.log('querystring', qs);
  const url = `https://api.themoviedb.org/3/search/tv?api_key=662c8478635d4f25ee66abbe201e121d&query=${qs}`;
  console.log('url', url);

  const response = await fetch(url);
  const list = await response.json();
  const resultList = list.results;
  updateList(resultList);
};


const updateList = list => {
  const $list = document.querySelector('.overview__list');
  $list.innerHTML = ' ';
  let listInner = '<li>';
  const $form = document.querySelector('.filter-form');
  const data = new FormData($form);
  const entries = [...data.entries()];
  console.log('entries:', entries);
  const qs = entries[1][1];
  console.log('querystring', qs);
  console.log(list);
  for (let i = 0;i < list.length;i ++) {
    console.log(list[i].name);
    listInner += `<h2 class="overview__list--title"> ${list[i].name}</h2>`;
  }
  $list.innerHTML += listInner;

};


export const init = async () => {
  document.documentElement.classList.add('has-js');
  document.querySelectorAll('.filter__field').forEach($field => $field.addEventListener('input', handleInputField));

};

