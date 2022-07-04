import { Card, Typography } from "antd";
import { useNavigate } from "react-router-dom";
import { createTodo } from "../../api/todo";
import TodoForm from "./TodoForm";

const NewTodo = () => {
  const navigate = useNavigate();
  const onSubmit = async (values) => {
    values.priority = Number(values.priority);
    try {
      await createTodo(values);
      navigate("/todos-list");
    } catch (err) {
      console.log(err);
    }
  };

  return (
    <Card
      title={<Typography.Title level={2}>New Todo</Typography.Title>}
      bordered={false}
    >
      <TodoForm onSubmit={onSubmit} />
    </Card>
  );
};

export default NewTodo;
