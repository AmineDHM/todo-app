import { Card, Typography } from "antd";
import { useState } from "react";
import { useNavigate } from "react-router-dom";
import { createTodo } from "../../api/todo";
import TodoForm from "./TodoForm";

const NewTodo = () => {
  const [loading, setLoading] = useState(false);
  const navigate = useNavigate();

  const onSubmit = (values) => {
    setLoading(true);
    createTodo(values)
      .then(() => {
        setLoading(false);
        navigate("/todos-list");
      })
      .catch((err) => console.log(err));
  };

  return (
    <Card
      title={<Typography.Title level={2}>New Todo</Typography.Title>}
      bordered={false}
    >
      <TodoForm onSubmit={onSubmit} loading={loading} />
    </Card>
  );
};

export default NewTodo;
