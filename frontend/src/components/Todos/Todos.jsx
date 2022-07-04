import React, { useEffect, useState } from "react";
import { deleteTodo, fetchAllTodos } from "../../api/todo";
import { Card, Col, Input, Row, Select, Typography } from "antd";
import Spinner from "../Spinner/Spinner";
import "./style.css";
import TodoItem from "./TodoItem";

const Todos = () => {
  const [todos, setTodos] = useState([]);
  const [loading, setLoading] = useState(true);
  const [search, setSearch] = useState("");

  useEffect(() => {
    const fetch = async () => {
      try {
        const res = await fetchAllTodos();
        setTodos(res.data);
        setLoading(false);
      } catch (err) {
        console.log(err);
      }
    };
    fetch();
  }, []);

  const handleDelete = async (id) => {
    try {
      await deleteTodo({ ids: [id] });
      setTodos(todos.filter((t) => t.id !== id));
    } catch (err) {
      console.log(err.message);
    }
  };

  const handleSearch = (e) => {
    console.log(e.target.value)
    const filteredTodos = todos.filter((t) =>
      t.name.toLowerCase().includes(e.target.value.toLowerCase())
    );
    console.log(filteredTodos)
    setTodos(filteredTodos);
  };

  return (
    <>
      {loading && <Spinner />}
      <Card
        title={<Typography.Title level={2}>Todos List</Typography.Title>}
        bordered={false}
      >
        <Row>
          <Col span={6}>
            <Typography.Title level={3} strong>
              Filter By Status :
            </Typography.Title>
          </Col>
          <Col span={6}>
            <Select defaultValue="select" style={{ width: 150 }}>
              <Select.Option value="select" disabled>
                Select Status...
              </Select.Option>
              <Select.Option value="todo">TODO</Select.Option>
              <Select.Option value="in-progress">IN-PROGRESS</Select.Option>
              <Select.Option value="done">DONE</Select.Option>
            </Select>
          </Col>
          <Col span={4} offset={8}>
            <Input placeholder="Search..." onChange={handleSearch} />
          </Col>
        </Row>
        <Row gutter={[24, 14]}>
          {!loading &&
            todos.map((todo) => (
              <Col
                lg={{ span: 6 }}
                md={{ span: 8 }}
                sm={{ span: 12 }}
                xs={{ span: 24 }}
                key={todo.id}
              >
                <TodoItem todo={todo} handleDelete={handleDelete} />
              </Col>
            ))}
        </Row>
      </Card>
    </>
  );
};

export default Todos;
