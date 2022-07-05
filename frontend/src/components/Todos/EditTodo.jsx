import { Card, Typography } from "antd";
import React, { useEffect, useState } from "react";
import { useNavigate, useParams } from "react-router-dom";
import { fetchOneTodo, updateTodo } from "../../api/todo";
import Spinner from "../Spinner/Spinner";
import TodoForm from "./TodoForm";

const EditTodo = () => {
  let navigate = useNavigate();
  const { id } = useParams();
  const [todo, setTodo] = useState(null);
  const [loading, setLoading] = useState(false);

  useEffect(() => {
    fetchOneTodo(id)
      .then((data) => {
        setTodo(data);
      })
      .catch((err) => console.log(err));
  }, [id]);

  const onSubmit = (values) => {
    setLoading(true);
    updateTodo(values, id)
      .then(() => {
        setLoading(false);
        navigate("/todos-list");
      })
      .catch((err) => console.log(err));
  };
  return (
    <>
      <Card
        title={<Typography.Title level={2}>Edit Todo</Typography.Title>}
        bordered={false}
      >
        {!todo && <Spinner />}
        {todo && <TodoForm onSubmit={onSubmit} todo={todo} loading={loading} />}
      </Card>
    </>
  );
};

export default EditTodo;
