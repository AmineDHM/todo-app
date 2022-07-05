import React from "react";
import { DeleteOutlined, EditOutlined } from "@ant-design/icons";
import {
  Badge,
  Button,
  Card,
  Col,
  Divider,
  Row,
  Space,
  Tag,
  Typography,
} from "antd";
import { useNavigate } from "react-router-dom";

const TodoItem = ({ todo, handleDelete }) => {
  const colors = ["green", "blue", "red"];
  const status = todo.status === "done" ? 0 : todo.status === "todo" ? 1 : 2;
  const priority = todo.priority === "low" ? 0 : todo.priority === "meduim" ? 1 : 2
  const navigate = useNavigate();

  return (
    <Badge.Ribbon
      text={todo.priority}
      color={colors[priority]}
    >
      <Card hoverable>
        <Row>
          <Col span={8}>
            <Typography.Text strong>{todo.name}</Typography.Text>
          </Col>
          <Col span={8} offset={8}></Col>
        </Row>
        <Row>
          <Col span={24}>
            <Typography.Text type="secondary">
              {todo.description}
            </Typography.Text>
          </Col>
        </Row>
        <Divider type="horizontal" />
        <Row>
          <Col span={8}>
            <Tag color={colors[status]} className="custom-tag">
              {todo.status.toUpperCase()}
            </Tag>
          </Col>
          <Col span={8} offset={8}>
            <Space size="middle">
              <Button
                type="text"
                shape="circle"
                icon={<EditOutlined />}
                size="large"
                onClick={() => navigate(`edit/${todo.id}`)}
              />
              <Button
                type="text"
                shape="circle"
                icon={<DeleteOutlined />}
                size="large"
                danger
                onClick={() => handleDelete(todo.id)}
              />
            </Space>
          </Col>
        </Row>
      </Card>
    </Badge.Ribbon>
  );
};

export default TodoItem;
