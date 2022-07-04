import axios from "axios";

const BASE_URL = "http://127.0.0.1:8000";

const fetchAllTodos = async () => {
  return await axios.get(`${BASE_URL}/todo`);
};

const fetchOneTodo = async (id) => {
  return await axios.get(`${BASE_URL}/todo/get/${id}`);
};

const createTodo = async (todo) => {
  return await axios.post(`${BASE_URL}/todo`, todo);
};

const updateTodo = async (updates, id) => {
  return await axios.patch(`${BASE_URL}/todo/${id}`, updates);
};

const deleteTodo = async (todosId) => {
  console.log(todosId);
  return await axios.delete(`${BASE_URL}/todo`, { data: todosId });
};

export { fetchAllTodos, fetchOneTodo, createTodo, updateTodo, deleteTodo };
