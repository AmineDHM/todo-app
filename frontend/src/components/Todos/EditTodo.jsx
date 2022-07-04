import { Card, Typography } from "antd";
import React, { useEffect, useState } from "react";
import { useNavigate, useParams } from "react-router-dom";
import { fetchOneTodo, updateTodo } from "../../api/todo";
import Spinner from "../Spinner/Spinner";
import TodoForm from "./TodoForm";

const EditTodo = () => {
  let navigate = useNavigate();
  const { id } = useParams();
  const [todo, setTodo] = useState({});
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const fetchTodo = async (id) => {
      try {
        const res = await fetchOneTodo(id);
        setTodo(res.data);
        setLoading(false);
      } catch (err) {
        console.log(err);
      }
    };
    if (id) {
      fetchTodo(id);
    }
  }, [id]);

  const onSubmit = async (values) => {
    values.priority = Number(values.priority);
    try {
      await updateTodo(values, id);
      navigate("/todos-list");
    } catch (err) {
      console.log(err);
    }
  };
  return (
    <>
      {loading && <Spinner />}
      {!loading && (
        <Card
          title={<Typography.Title level={2}>Edit Todo</Typography.Title>}
          bordered={false}
        >
          <TodoForm onSubmit={onSubmit} todo={todo} />
        </Card>
      )}
    </>
  );
};

export default EditTodo;
