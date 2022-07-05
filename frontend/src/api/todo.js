import axios from "axios";

const BASE_URL = "http://127.0.0.1:8000";

export const fetchAllTodos = () => {
  return axios.get(`${BASE_URL}/todo`).then(({ data }) => data);
};

export const fetchOneTodo = (id) => {
  return axios.get(`${BASE_URL}/todo/get/${id}`).then(({ data }) => data);
};

export const createTodo = (todo) => {
  return axios.post(`${BASE_URL}/todo`, todo).then(({ data }) => data);
};

export const updateTodo = (updates, id) => {
  return axios
    .patch(`${BASE_URL}/todo/${id}`, updates)
    .then(({ data }) => data);
};

export const deleteTodo = (todosId) => {
  return axios
    .delete(`${BASE_URL}/todo`, { data: todosId })
    .then(({ data }) => data);
};

export const filterByStatus = (status) => {
  return axios
    .get(`${BASE_URL}/todo/filter?status=${status}`)
    .then(({ data }) => data);
};
